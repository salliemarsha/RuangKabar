<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    private const TYPES = [
        'artikel' => 'Artikel',
        'pengguna' => 'Pengguna',
        'komentar' => 'Komentar',
        'kategori' => 'Kategori & Tag',
    ];

    private const COLORS = [
        'forest' => '#376B5C',
        'gold' => '#B99A64',
        'emerald' => '#183C36',
        'mint' => '#8FB3A5',
        'danger' => '#A3392C',
        'grey' => '#68736E',
    ];

    public function articles(Request $request)
    {
        $type = (string) $request->query('jenis', 'artikel');

        if (! array_key_exists($type, self::TYPES)) {
            $type = 'artikel';
        }

        [$from, $to] = $this->period($request);

        $report = match ($type) {
            'pengguna' => $this->usersReport($request, $from, $to),
            'komentar' => $this->commentsReport($request, $from, $to),
            'kategori' => $this->taxonomyReport($from, $to),
            default => $this->articlesReport($request, $from, $to),
        };

        $summary = collect($report['filters'] ?? [])
            ->filter(fn ($filter) => $filter['value'] !== '')
            ->map(fn ($filter) => $filter['label'] . ': ' . ($filter['options'][$filter['value']] ?? $filter['value']))
            ->implode(' | ');

        return view('reports.articles', [
            'report' => $report,
            'type' => $type,
            'types' => self::TYPES,
            'from' => $from,
            'to' => $to,
            'presets' => $this->presets($request),
            'periodLabel' => $this->periodLabel($from, $to),
            'filterSummary' => $summary !== '' ? $summary : 'Tanpa filter tambahan',
        ]);
    }

    private function articlesReport(Request $request, ?Carbon $from, ?Carbon $to): array
    {
        $status = in_array($request->query('status'), ['published', 'draft'], true) ? $request->query('status') : '';
        $categoryParam = (string) $request->query('kategori', '');
        $categoryId = ctype_digit($categoryParam) ? (int) $categoryParam : 0;

        $articles = $this->within(Article::query()->with(['category', 'user']), $from, $to)
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->when($categoryId > 0, fn ($query) => $query->where('category_id', $categoryId))
            ->latest()
            ->get();

        $published = $articles->where('status', 'published')->count();
        $draft = $articles->where('status', 'draft')->count();
        $other = $articles->count() - $published - $draft;
        $authors = $articles->pluck('user_id')->filter()->unique()->count();

        $donut = [
            ['label' => 'Published', 'value' => $published, 'color' => self::COLORS['forest']],
            ['label' => 'Draft', 'value' => $draft, 'color' => self::COLORS['gold']],
        ];

        if ($other > 0) {
            $donut[] = ['label' => 'Lainnya', 'value' => $other, 'color' => self::COLORS['mint']];
        }

        $rows = $articles->values()->map(fn ($article, $i) => [
            $i + 1,
            ['t' => $article->title, 'href' => route('articles.show', $article)],
            $article->user->name ?? '-',
            $article->category->name ?? '-',
            ['badge' => ucfirst((string) $article->status), 'tone' => in_array($article->status, ['published', 'draft'], true) ? $article->status : 'other'],
            $this->dateText($article->created_at),
        ])->all();

        return [
            'label' => 'Artikel',
            'title' => 'Laporan Artikel',
            'description' => 'Ringkasan publikasi berita: jumlah artikel, status terbit, penulis aktif, serta tren pembuatan artikel pada periode yang dipilih.',
            'filters' => [
                ['name' => 'status', 'label' => 'Status', 'value' => $status, 'options' => ['' => 'Semua status', 'published' => 'Published', 'draft' => 'Draft']],
                ['name' => 'kategori', 'label' => 'Kategori', 'value' => $categoryId > 0 ? (string) $categoryId : '', 'options' => ['' => 'Semua kategori'] + Category::orderBy('name')->pluck('name', 'id')->all()],
            ],
            'stats' => [
                ['label' => 'Total Artikel', 'value' => $articles->count(), 'note' => 'Pada periode dan filter terpilih', 'icon' => 'article', 'tone' => 'dark'],
                ['label' => 'Artikel Terbit', 'value' => $published, 'note' => 'Sudah tayang di portal', 'icon' => 'check', 'tone' => 'forest'],
                ['label' => 'Artikel Draft', 'value' => $draft, 'note' => 'Belum dipublikasikan', 'icon' => 'draft', 'tone' => 'gold'],
                ['label' => 'Penulis Aktif', 'value' => $authors, 'note' => 'Penulis yang memiliki artikel', 'icon' => 'users', 'tone' => 'emerald'],
            ],
            'chart_layout' => 'split',
            'charts' => [
                ['type' => 'bar', 'title' => 'Tren Pembuatan Artikel', 'unit' => 'artikel', 'items' => $this->monthly($articles->pluck('created_at'), $from, $to)],
                ['type' => 'donut', 'title' => 'Status Artikel', 'sub' => 'Distribusi artikel pada periode', 'unit' => 'Artikel', 'items' => $donut],
            ],
            'tables' => [[
                'title' => 'Daftar Artikel',
                'sub' => 'Diurutkan dari yang terbaru',
                'columns' => [
                    ['label' => 'No.', 'class' => 'col-no'],
                    ['label' => 'Judul Artikel', 'class' => 'col-main'],
                    ['label' => 'Penulis'],
                    ['label' => 'Kategori'],
                    ['label' => 'Status'],
                    ['label' => 'Tanggal Dibuat', 'class' => 'col-date'],
                ],
                'rows' => $rows,
                'empty' => 'Tidak ada artikel pada periode dan filter yang dipilih.',
            ]],
        ];
    }

    private function usersReport(Request $request, ?Carbon $from, ?Carbon $to): array
    {
        $role = in_array($request->query('role'), ['admin', 'penulis', 'pengguna'], true) ? $request->query('role') : '';

        $users = $this->within(User::query()->withCount(['articles', 'comments']), $from, $to)
            ->when($role !== '', fn ($query) => $query->where('role', $role))
            ->latest()
            ->get();

        $roleLabels = ['admin' => 'Admin', 'penulis' => 'Penulis', 'pengguna' => 'Pembaca'];

        $count = fn (string $key) => $users->where('role', $key)->count();

        $rows = $users->values()->map(fn ($user, $i) => [
            $i + 1,
            $user->name,
            $user->email,
            ['badge' => $roleLabels[$user->role] ?? ucfirst((string) $user->role), 'tone' => $user->role],
            $user->articles_count,
            $user->comments_count,
            $this->dateText($user->created_at),
        ])->all();

        return [
            'label' => 'Pengguna',
            'title' => 'Laporan Pengguna',
            'description' => 'Ringkasan akun terdaftar: komposisi peran, pertumbuhan pendaftaran, serta kontribusi artikel dan komentar setiap pengguna.',
            'filters' => [
                ['name' => 'role', 'label' => 'Peran', 'value' => $role, 'options' => ['' => 'Semua peran', 'admin' => 'Admin', 'penulis' => 'Penulis', 'pengguna' => 'Pembaca']],
            ],
            'stats' => [
                ['label' => 'Total Pengguna', 'value' => $users->count(), 'note' => 'Akun pada periode dan filter terpilih', 'icon' => 'users', 'tone' => 'dark'],
                ['label' => 'Penulis', 'value' => $count('penulis'), 'note' => 'Akun dengan peran penulis', 'icon' => 'pen', 'tone' => 'forest'],
                ['label' => 'Pembaca', 'value' => $count('pengguna'), 'note' => 'Akun dengan peran pembaca', 'icon' => 'book', 'tone' => 'gold'],
                ['label' => 'Admin', 'value' => $count('admin'), 'note' => 'Akun pengelola portal', 'icon' => 'shield', 'tone' => 'emerald'],
            ],
            'chart_layout' => 'split',
            'charts' => [
                ['type' => 'bar', 'title' => 'Pendaftaran Pengguna', 'unit' => 'pengguna', 'items' => $this->monthly($users->pluck('created_at'), $from, $to)],
                ['type' => 'donut', 'title' => 'Komposisi Peran', 'sub' => 'Distribusi akun pada periode', 'unit' => 'Pengguna', 'items' => [
                    ['label' => 'Pembaca', 'value' => $count('pengguna'), 'color' => self::COLORS['gold']],
                    ['label' => 'Penulis', 'value' => $count('penulis'), 'color' => self::COLORS['forest']],
                    ['label' => 'Admin', 'value' => $count('admin'), 'color' => self::COLORS['emerald']],
                ]],
            ],
            'tables' => [[
                'title' => 'Daftar Pengguna',
                'sub' => 'Diurutkan dari pendaftar terbaru',
                'columns' => [
                    ['label' => 'No.', 'class' => 'col-no'],
                    ['label' => 'Nama', 'class' => 'col-main'],
                    ['label' => 'Email'],
                    ['label' => 'Peran'],
                    ['label' => 'Artikel', 'class' => 'col-num'],
                    ['label' => 'Komentar', 'class' => 'col-num'],
                    ['label' => 'Terdaftar', 'class' => 'col-date'],
                ],
                'rows' => $rows,
                'empty' => 'Tidak ada pengguna pada periode dan filter yang dipilih.',
            ]],
        ];
    }

    private function commentsReport(Request $request, ?Carbon $from, ?Carbon $to): array
    {
        $status = in_array($request->query('status'), ['pending', 'approved', 'rejected'], true) ? $request->query('status') : '';

        $comments = $this->within(Comment::query()->with(['user', 'article']), $from, $to)
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->latest()
            ->get();

        $count = fn (string $key) => $comments->where('status', $key)->count();

        $rows = $comments->values()->map(fn ($comment, $i) => [
            $i + 1,
            $comment->user->name ?? 'Pengguna',
            $comment->article
                ? ['t' => Str::limit($comment->article->title, 60), 'href' => route('articles.show', $comment->article)]
                : 'Artikel tidak tersedia',
            Str::limit(strip_tags((string) $comment->comment), 110),
            ['badge' => ucfirst((string) $comment->status), 'tone' => in_array($comment->status, ['pending', 'approved', 'rejected'], true) ? $comment->status : 'other'],
            $this->dateText($comment->created_at),
        ])->all();

        return [
            'label' => 'Komentar',
            'title' => 'Laporan Komentar',
            'description' => 'Ringkasan komentar pembaca: volume komentar, hasil moderasi, serta tren komentar masuk pada periode yang dipilih.',
            'filters' => [
                ['name' => 'status', 'label' => 'Status', 'value' => $status, 'options' => ['' => 'Semua status', 'pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected']],
            ],
            'stats' => [
                ['label' => 'Total Komentar', 'value' => $comments->count(), 'note' => 'Pada periode dan filter terpilih', 'icon' => 'comment', 'tone' => 'dark'],
                ['label' => 'Approved', 'value' => $count('approved'), 'note' => 'Tampil di halaman artikel', 'icon' => 'check', 'tone' => 'forest'],
                ['label' => 'Pending', 'value' => $count('pending'), 'note' => 'Menunggu moderasi', 'icon' => 'clock', 'tone' => 'gold'],
                ['label' => 'Rejected', 'value' => $count('rejected'), 'note' => 'Tidak ditampilkan', 'icon' => 'x', 'tone' => 'emerald'],
            ],
            'chart_layout' => 'split',
            'charts' => [
                ['type' => 'bar', 'title' => 'Tren Komentar Masuk', 'unit' => 'komentar', 'items' => $this->monthly($comments->pluck('created_at'), $from, $to)],
                ['type' => 'donut', 'title' => 'Status Komentar', 'sub' => 'Hasil moderasi pada periode', 'unit' => 'Komentar', 'items' => [
                    ['label' => 'Approved', 'value' => $count('approved'), 'color' => self::COLORS['forest']],
                    ['label' => 'Pending', 'value' => $count('pending'), 'color' => self::COLORS['gold']],
                    ['label' => 'Rejected', 'value' => $count('rejected'), 'color' => self::COLORS['danger']],
                ]],
            ],
            'tables' => [[
                'title' => 'Daftar Komentar',
                'sub' => 'Diurutkan dari yang terbaru',
                'columns' => [
                    ['label' => 'No.', 'class' => 'col-no'],
                    ['label' => 'Pengguna'],
                    ['label' => 'Artikel', 'class' => 'col-main'],
                    ['label' => 'Komentar', 'class' => 'col-wide'],
                    ['label' => 'Status'],
                    ['label' => 'Tanggal', 'class' => 'col-date'],
                ],
                'rows' => $rows,
                'empty' => 'Tidak ada komentar pada periode dan filter yang dipilih.',
            ]],
        ];
    }

    private function taxonomyReport(?Carbon $from, ?Carbon $to): array
    {
        $constraint = fn ($query) => $this->within($query, $from, $to, 'articles.created_at');

        $categories = Category::withCount(['articles' => $constraint])
            ->orderByDesc('articles_count')
            ->orderBy('name')
            ->get();

        $tags = Tag::withCount(['articles' => $constraint])
            ->orderByDesc('articles_count')
            ->orderBy('name')
            ->get();

        $rank = fn (Collection $items) => $items->take(8)->map(fn ($item) => [
            'label' => $item->name,
            'value' => (int) $item->articles_count,
        ])->values()->all();

        $table = fn (Collection $items, string $title, string $firstLabel, string $empty) => [
            'title' => $title,
            'sub' => 'Jumlah artikel dihitung pada periode terpilih',
            'columns' => [
                ['label' => 'No.', 'class' => 'col-no'],
                ['label' => $firstLabel, 'class' => 'col-main'],
                ['label' => 'Slug'],
                ['label' => 'Jumlah Artikel', 'class' => 'col-num'],
            ],
            'rows' => $items->values()->map(fn ($item, $i) => [
                $i + 1,
                $item->name,
                $item->slug,
                (int) $item->articles_count,
            ])->all(),
            'empty' => $empty,
        ];

        return [
            'label' => 'Kategori & Tag',
            'title' => 'Laporan Kategori & Tag',
            'description' => 'Ringkasan pemakaian kategori dan tag: kategori serta tag yang paling sering dipakai pada artikel dalam periode yang dipilih.',
            'filters' => [],
            'stats' => [
                ['label' => 'Total Kategori', 'value' => $categories->count(), 'note' => 'Seluruh kategori terdaftar', 'icon' => 'folder', 'tone' => 'dark'],
                ['label' => 'Kategori Terpakai', 'value' => $categories->where('articles_count', '>', 0)->count(), 'note' => 'Memiliki artikel pada periode', 'icon' => 'check', 'tone' => 'forest'],
                ['label' => 'Total Tag', 'value' => $tags->count(), 'note' => 'Seluruh tag terdaftar', 'icon' => 'tag', 'tone' => 'gold'],
                ['label' => 'Tag Terpakai', 'value' => $tags->where('articles_count', '>', 0)->count(), 'note' => 'Dipakai artikel pada periode', 'icon' => 'check', 'tone' => 'emerald'],
            ],
            'chart_layout' => 'equal',
            'charts' => [
                ['type' => 'rank', 'title' => 'Artikel per Kategori', 'sub' => 'Delapan kategori teratas', 'unit' => 'artikel', 'items' => $rank($categories)],
                ['type' => 'rank', 'title' => 'Artikel per Tag', 'sub' => 'Delapan tag teratas', 'unit' => 'artikel', 'items' => $rank($tags)],
            ],
            'tables' => [
                $table($categories, 'Daftar Kategori', 'Kategori', 'Belum ada kategori terdaftar.'),
                $table($tags, 'Daftar Tag', 'Tag', 'Belum ada tag terdaftar.'),
            ],
        ];
    }

    private function period(Request $request): array
    {
        $from = $this->parseDate($request->query('dari'));
        $to = $this->parseDate($request->query('sampai'));

        if ($from && $to && $from->gt($to)) {
            [$from, $to] = [$to, $from];
        }

        return [$from?->startOfDay(), $to?->endOfDay()];
    }

    private function parseDate($value): ?Carbon
    {
        if (! is_string($value) || $value === '') {
            return null;
        }

        try {
            return Carbon::createFromFormat('Y-m-d', $value);
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function within($query, ?Carbon $from, ?Carbon $to, string $column = 'created_at')
    {
        return $query
            ->when($from, fn ($q) => $q->where($column, '>=', $from))
            ->when($to, fn ($q) => $q->where($column, '<=', $to));
    }

    private function monthly(Collection $dates, ?Carbon $from, ?Carbon $to): array
    {
        $end = ($to ?? now())->copy()->startOfMonth();
        $start = $from ? $from->copy()->startOfMonth() : $end->copy()->subMonths(5);

        if ($start->gt($end)) {
            $end = $start->copy();
        }

        if ($start->diffInMonths($end) > 11) {
            $start = $end->copy()->subMonths(11);
        }

        $counts = $dates->filter()->countBy(fn ($date) => Carbon::parse($date)->format('Y-m'));

        $items = [];

        for ($month = $start->copy(); $month->lte($end); $month->addMonth()) {
            $items[] = [
                'label' => $month->copy()->locale('id')->translatedFormat('M Y'),
                'full' => $month->copy()->locale('id')->translatedFormat('F Y'),
                'value' => (int) ($counts[$month->format('Y-m')] ?? 0),
            ];
        }

        return $items;
    }

    private function presets(Request $request): array
    {
        $today = now();

        $ranges = [
            'Semua periode' => [null, null],
            '30 hari' => [$today->copy()->subDays(29), $today],
            '3 bulan' => [$today->copy()->subMonths(3)->addDay(), $today],
            '6 bulan' => [$today->copy()->subMonths(6)->addDay(), $today],
            '12 bulan' => [$today->copy()->subMonths(12)->addDay(), $today],
            'Tahun ini' => [$today->copy()->startOfYear(), $today],
        ];

        $keep = collect($request->query())->except(['dari', 'sampai'])->all();
        $currentFrom = (string) $request->query('dari', '');
        $currentTo = (string) $request->query('sampai', '');

        $presets = [];

        foreach ($ranges as $label => [$start, $finish]) {
            $dari = $start ? $start->toDateString() : '';
            $sampai = $finish ? $finish->toDateString() : '';

            $presets[] = [
                'label' => $label,
                'url' => route('reports.articles', array_filter(array_merge($keep, ['dari' => $dari, 'sampai' => $sampai]), fn ($v) => $v !== '' && $v !== null)),
                'active' => $currentFrom === $dari && $currentTo === $sampai,
            ];
        }

        return $presets;
    }

    private function periodLabel(?Carbon $from, ?Carbon $to): string
    {
        $format = fn (Carbon $date) => $date->copy()->locale('id')->translatedFormat('d F Y');

        if ($from && $to) {
            return $format($from) . ' - ' . $format($to);
        }

        if ($from) {
            return 'Sejak ' . $format($from);
        }

        if ($to) {
            return 'Hingga ' . $format($to);
        }

        return 'Semua periode';
    }

    private function dateText($date): string
    {
        return $date ? Carbon::parse($date)->locale('id')->translatedFormat('d M Y') : '-';
    }
}
