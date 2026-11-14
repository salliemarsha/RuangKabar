
<?php

return [
    'enabled' => true,

    'thresholds' => [
        'max_length' => 1000,
        'repeat_char_run' => 6,
        'min_caps_letters' => 10,
        'max_caps_ratio' => 0.75,
        'min_words_unique_check' => 8,
        'min_unique_ratio' => 0.35,
        'duplicate_window_hours' => 24,
        'burst_window_seconds' => 60,
        'burst_limit' => 5,
        'max_links' => 2,
    ],

    'profanity_strong' => [
        'anjing',
        'bangsat',
        'bajingan',
        'brengsek',
        'kontol',
        'memek',
        'ngentot',
        'goblok',
        'tolol',
        'idiot',
    ],

    'insult_mild' => [
        'bodoh',
        'dungu',
        'payah',
        'sampah',
        'pecundang',
    ],

    'insult_animal' => [
        'monyet',
        'babi',
        'kampret',
    ],

    'targets' => [
        'kamu',
        'kau',
        'anda',
        'dia',
        'mereka',
        'orang',
        'penulis',
        'admin',
        'wartawan',
    ],

    'groups' => [
        'suku',
        'ras',
        'agama',
        'etnis',
        'bangsa',
        'golongan',
    ],

    'violence' => [
        'bunuh',
        'bantai',
        'habisi',
        'bakar',
        'serang',
    ],

    'dehumanizing' => [
        'hewan',
        'binatang',
    ],

    'hate_patterns' => [
        '/\b(?:harus|wajib)\s+(?:dibunuh|dibantai|dimusnahkan)\b/iu',
        '/\b(?:usir|basmi)\s+(?:semua|seluruh)\b/iu',
    ],

    'promo_terms' => [
        'jual',
        'promo',
        'diskon',
        'hubungi',
        'whatsapp',
        'wa',
        'order',
        'beli',
        'murah',
        'gratis',
        'bonus',
    ],

    'gambling_terms' => [
        'judi',
        'slot',
        'togel',
        'casino',
        'jackpot',
        'gacor',
        'betting',
    ],

    'link_tlds' => [
        'com',
        'net',
        'org',
        'id',
        'co',
        'xyz',
        'top',
        'info',
        'site',
        'online',
    ],

    'link_shorteners' => [
        'bit.ly',
        'tinyurl.com',
        't.co',
        'cutt.ly',
        'shorturl.at',
    ],

    'link_bad_tlds' => [
        'xyz',
        'top',
        'click',
        'work',
        'rest',
    ],
];
