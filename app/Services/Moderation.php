<?php

/*
 * Aturan moderasi komentar RuangKabar (rule-based, tanpa layanan eksternal).
 * Semua daftar dicocokkan tanpa membedakan huruf besar/kecil, dengan normalisasi
 * angka pengganti huruf (k0nt0l) dan huruf berulang (anjiiing).
 * Tambah atau kurangi kata di sini; tidak perlu mengubah kode.
 */
return [

    // Kata kasar yang ditahan kapan pun muncul.
    'profanity_strong' => [
        'kontol', 'memek', 'pepek', 'ngentot', 'jancok', 'jancuk', 'bangsat',
        'bajingan', 'keparat', 'brengsek',
    ],

    // Penghinaan ringan: hanya ditahan jika ditujukan ke orang (dekat kata 'targets').
    // Kritik seperti "kebijakan ini bodoh" tidak ikut tertahan.
    'insult_mild' => [
        'bodoh', 'tolol', 'goblok', 'bego', 'idiot', 'dungu', 'sinting',
        'sampah', 'kampret', 'sialan',
    ],

    // Kata hewan yang bisa wajar (anjing pelacak), ditahan hanya jika dipakai sebagai umpatan.
    'insult_animal' => ['anjing', 'anjg', 'asu', 'babi', 'monyet'],

    // Kata yang menunjuk orang yang sedang dihina atau diancam.
    'targets' => [
        'kamu', 'kau', 'lu', 'lo', 'loe', 'anda', 'dasar', 'kalian',
        'penulis', 'wartawan', 'redaksi',
    ],

    // Ujaran kebencian: kelompok + kata merendahkan/kekerasan berdekatan.
    'groups' => [
        'cina', 'china', 'tionghoa', 'yahudi', 'kristen', 'katolik', 'islam',
        'muslim', 'hindu', 'buddha', 'budha', 'papua', 'jawa', 'batak',
        'madura', 'arab', 'ahmadiyah', 'syiah', 'lgbt', 'pribumi',
    ],
    'dehumanizing' => ['babi', 'anjing', 'monyet', 'kecoa', 'kutu', 'hama', 'parasit', 'iblis'],
    'violence' => ['bunuh', 'bantai', 'habisi', 'musnahkan', 'basmi', 'usir'],
    'hate_patterns' => [
        '/\b(mati|matilah)\s+(saja|aja|lu|kau|kamu)\b/u',
    ],

    // Promosi: dua istilah berbeda, atau satu istilah + nomor telepon/tautan.
    'promo_terms' => [
        'jual', 'dijual', 'diskon', 'promo', 'hubungi', 'whatsapp', 'wa', 'order',
        'pesan sekarang', 'klik link', 'klik di sini', 'gratis ongkir', 'cod',
        'dapatkan', 'penghasilan', 'cuan', 'investasi', 'follow', 'subscribe',
        'kunjungi', 'telegram', 'daftar sekarang', 'bonus', 'murah',
    ],
    // Promosi judi/pinjaman ilegal: satu istilah saja sudah ditahan.
    'gambling_terms' => [
        'slot gacor', 'judi online', 'togel', 'situs slot', 'pinjol', 'pinjaman online',
        'sbobet', 'casino online', 'bandar bola', 'link alternatif', 'rtp slot', 'maxwin', 'jackpot',
    ],

    // Tautan
    'link_tlds' => [
        'com', 'net', 'org', 'id', 'co', 'io', 'xyz', 'top', 'click', 'link', 'info',
        'biz', 'site', 'online', 'shop', 'ru', 'tk', 'ml', 'ga', 'cf', 'gq', 'me',
        'ly', 'to', 'cc', 'vip', 'bet', 'app', 'dev',
    ],
    'link_bad_tlds' => ['xyz', 'top', 'click', 'link', 'site', 'online', 'shop', 'tk', 'ml', 'ga', 'cf', 'gq', 'vip', 'bet', 'ru', 'cc', 'biz', 'info'],
    'link_shorteners' => [
        'bit.ly', 'tinyurl.com', 't.co', 'cutt.ly', 's.id', 'is.gd', 'ow.ly',
        'rebrand.ly', 'shorturl.at', 'goo.gl', 'wa.me', 't.me', 'linktr.ee',
    ],

    'thresholds' => [
        'max_length' => 2000,
        'repeat_char_run' => 8,          // 8+ karakter sama berurutan
        'min_caps_letters' => 15,        // huruf kapital dicek jika huruf >= 15
        'max_caps_ratio' => 0.7,
        'min_words_unique_check' => 8,   // cek keragaman kata jika kata >= 8
        'min_unique_ratio' => 0.4,
        'max_links' => 2,
        'duplicate_window_hours' => 24,  // komentar sama dari pengguna yang sama
        'burst_limit' => 5,              // 5 komentar dalam jendela di bawah
        'burst_window_seconds' => 60,
    ],
];