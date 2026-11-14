<?php

namespace App\Services;

use App\Models\Comment;

class CommentModerator
{
    public const APPROVED = 'approved';
    public const PENDING = 'pending';

    private const R_PROFANITY = 'Kata kasar atau penghinaan';
    private const R_HATE = 'Indikasi ujaran kebencian atau ancaman';
    private const R_SPAM = 'Terindikasi spam';
    private const R_PROMO = 'Promosi berlebihan';
    private const R_LINK = 'Mengandung tautan (perlu diperiksa)';
    private const R_BAD_LINK = 'Tautan mencurigakan';
    private const R_UNCLEAR = 'Isi komentar tidak jelas (perlu diperiksa)';
    private const R_DUP = 'Komentar berulang (duplikat)';
    private const R_BURST = 'Terlalu banyak komentar dalam waktu singkat';

    private array $cfg;
    private array $sets = [];

    public function __construct()
    {
        $this->cfg = config('moderation');
    }

    public function analyze(string $text, ?int $userId = null): array
    {
        $reasons = $this->inspectText($text);

        if ($userId) {
            $reasons = array_merge($reasons, $this->inspectHistory($text, $userId));
        }

        $reasons = array_values(array_unique($reasons));

        return [
            'status' => $reasons ? self::PENDING : self::APPROVED,
            'reasons' => $reasons,
        ];
    }

    public function inspectText(string $text): array
    {
        $text = trim($text);
        $reasons = [];
        $t = $this->cfg['thresholds'];
        $c = $this->candidates($text);

        $targets = $this->positions($c, 'targets');
        $groups = $this->positions($c, 'groups');
        $violence = $this->positions($c, 'violence');
        $harm = array_merge(
            $this->positions($c, 'dehumanizing'),
            $violence
        );

        if (
            $this->positions($c, 'profanity_strong')
            || $this->positions($c, 'insult_mild')
            || $this->positions($c, 'insult_animal')
        ) {
            $reasons[] = self::R_PROFANITY;
        }

        if (
            $this->near($groups, $harm, 3)
            || $this->near($targets, $violence, 3)
            || $this->matchesPattern($text, $this->cfg['hate_patterns'])
        ) {
            $reasons[] = self::R_HATE;
        }

        $letters = (int) preg_match_all('/\p{L}/u', $text);
        $upper = (int) preg_match_all('/\p{Lu}/u', $text);
        $words = preg_split('/\s+/u', mb_strtolower($text), -1, PREG_SPLIT_NO_EMPTY);

        if (
            preg_match('/(.)\1{' . ($t['repeat_char_run'] - 1) . ',}/su', $text)
            || ($letters >= $t['min_caps_letters'] && $upper / $letters > $t['max_caps_ratio'])
            || (
                count($words) >= $t['min_words_unique_check']
                && count(array_unique($words)) / count($words) < $t['min_unique_ratio']
            )
        ) {
            $reasons[] = self::R_SPAM;
        }

        $links = $this->extractLinks($text);

        if ($links) {
            $bad = count($links) > $t['max_links'];

            foreach ($links as $link) {
                $bad = $bad || $this->suspiciousHost($link);
            }

            $reasons[] = $bad ? self::R_BAD_LINK : self::R_LINK;
        }

        $lower = mb_strtolower($text);
        $hits = 0;

        foreach ($this->cfg['promo_terms'] as $term) {
            $hits += $this->hasTerm($lower, $term) ? 1 : 0;
        }

        $gambling = false;

        foreach ($this->cfg['gambling_terms'] as $term) {
            $gambling = $gambling || $this->hasTerm($lower, $term);
        }

        $phone = preg_match(
            '/(?:\+?62|0)8\d{8,11}/',
            preg_replace('/[\s.\-]/', '', $text)
        ) === 1;

        if ($gambling || $hits >= 2 || ($hits >= 1 && ($phone || $links))) {
            $reasons[] = self::R_PROMO;
        }

        if ($letters < 2) {
            $reasons[] = self::R_UNCLEAR;
        }

        return array_values(array_unique($reasons));
    }

    private function inspectHistory(string $text, int $userId): array
    {
        $t = $this->cfg['thresholds'];

        $recent = Comment::where('user_id', $userId)
            ->where('created_at', '>=', now()->subHours($t['duplicate_window_hours']))
            ->latest()
            ->limit(30)
            ->get(['comment', 'created_at']);

        $reasons = [];
        $fp = $this->fingerprint($text);

        if (
            $fp !== ''
            && $recent->contains(
                fn ($c) => $this->fingerprint($c->comment) === $fp
            )
        ) {
            $reasons[] = self::R_DUP;
        }

        $since = now()->subSeconds($t['burst_window_seconds']);

        if (
            $recent->filter(fn ($c) => $c->created_at >= $since)->count()
            >= $t['burst_limit']
        ) {
            $reasons[] = self::R_BURST;
        }

        return $reasons;
    }

    private function squeeze(string $word): string
    {
        return preg_replace('/(\p{L})\1+/u', '$1', $word);
    }

    private function set(string $key): array
    {
        return $this->sets[$key] ??= array_flip(array_map(
            fn ($w) => $this->squeeze(mb_strtolower($w)),
            $this->cfg[$key] ?? []
        ));
    }

    private function candidates(string $text): array
    {
        $out = [];

        foreach (
            preg_split('/[^\p{L}\p{N}]+/u', mb_strtolower($text), -1, PREG_SPLIT_NO_EMPTY)
            as $token
        ) {
            if (preg_match('/\p{L}/u', $token)) {
                $token = strtr($token, [
                    '0' => 'o',
                    '1' => 'i',
                    '3' => 'e',
                    '4' => 'a',
                    '5' => 's',
                    '7' => 't',
                ]);
            }

            $sq = $this->squeeze($token);

            $out[] = [
                $sq,
                preg_replace('/(nya|lah|kah|pun)$/u', '', $sq),
            ];
        }

        return $out;
    }

    private function positions(array $candidates, string $key): array
    {
        $set = $this->set($key);
        $hit = [];

        foreach ($candidates as $i => [$a, $b]) {
            if (isset($set[$a]) || ($b !== '' && isset($set[$b]))) {
                $hit[] = $i;
            }
        }

        return $hit;
    }

    private function near(array $a, array $b, int $distance): bool
    {
        foreach ($a as $i) {
            foreach ($b as $j) {
                if ($i !== $j && abs($i - $j) <= $distance) {
                    return true;
                }
            }
        }

        return false;
    }

    private function matchesPattern(string $text, array $patterns): bool
    {
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, mb_strtolower($text))) {
                return true;
            }
        }

        return false;
    }

    private function hasTerm(string $lowerText, string $term): bool
    {
        return preg_match(
            '/(?<![\p{L}\p{N}])' . preg_quote($term, '/') . '(?![\p{L}\p{N}])/u',
            $lowerText
        ) === 1;
    }

    private function extractLinks(string $text): array
    {
        $tlds = implode('|', array_map(
            fn ($tld) => preg_quote($tld, '/'),
            $this->cfg['link_tlds']
        ));

        preg_match_all(
            '~(?:https?://|www\.)\S+|\b[a-z0-9-]+(?:\.[a-z0-9-]+)*\.(?:' . $tlds . ')\b(?:/\S*)?~iu',
            $text,
            $m
        );

        return $m[0];
    }

    private function suspiciousHost(string $url): bool
    {
        $stripped = preg_replace(
            '~^(?:https?://)?(?:www\.)?~i',
            '',
            $url
        );

        $host = strtolower(preg_split('~[/?#]~', $stripped)[0]);
        $host = rtrim(
            preg_replace('/:\d+$/', '', $host),
            '.,;:!?)'
        );

        if ($host === '') {
            return false;
        }

        $tld = substr((string) strrchr($host, '.'), 1);

        return in_array($host, $this->cfg['link_shorteners'], true)
            || in_array($tld, $this->cfg['link_bad_tlds'], true)
            || preg_match('/^\d{1,3}(\.\d{1,3}){3}$/', $host) === 1
            || str_contains($host, 'xn--')
            || substr_count($host, '-') >= 3;
    }

    private function fingerprint(string $text): string
    {
        return preg_replace(
            '/[^\p{L}\p{N}]+/u',
            '',
            mb_strtolower($text)
        );
    }
}
