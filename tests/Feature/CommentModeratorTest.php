<?php

namespace Tests\Unit;

use App\Services\CommentModerator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CommentModeratorTest extends TestCase
{
    public static function safeComments(): array
    {
        return [
            'komentar normal' => ['Artikel ini informatif, terima kasih sudah menulisnya.'],
            'kritik wajar' => ['Saya tidak setuju dengan kebijakan ini, menurut saya anggarannya tidak transparan.'],
            'kritik keras ke kebijakan' => ['Kebijakan ini bodoh dan merugikan rakyat.'],
            'kata hewan wajar' => ['Anjing pelacak polisi memang terlatih.'],
            'menyebut kelompok netral' => ['Saya pernah ke Papua tahun lalu, indah sekali.'],
        ];
    }

    public static function flaggedComments(): array
    {
        return [
            'kata kasar' => ['dasar bangsat'],
            'kata kasar dengan angka' => ['k0nt0l'],
            'penghinaan ke orang' => ['kamu goblok banget'],
            'umpatan hewan' => ['Dasar anjing'],
            'ujaran kebencian' => ['usir semua Cina dari sini'],
            'judi' => ['slot gacor maxwin klik di sini'],
            'promosi + kontak' => ['Hubungi 081234567890 jual murah diskon'],
            'tautan pendek' => ['Cek https://bit.ly/abc123'],
            'tautan biasa (ditahan untuk diperiksa)' => ['Info menarik di https://kompas.com/berita'],
            'karakter berulang' => ['AAAAAAAAAAAAAAAAAA'],
            'huruf kapital berlebihan' => ['SAYA SANGAT MARAH DENGAN KEBIJAKAN INI SEKALI'],
            'tidak jelas' => ['!!!'],
        ];
    }

    #[DataProvider('safeComments')]
    public function test_komentar_aman_tidak_ditandai(string $text): void
    {
        $this->assertSame([], (new CommentModerator())->inspectText($text));
    }

    #[DataProvider('flaggedComments')]
    public function test_komentar_bermasalah_ditandai(string $text): void
    {
        $this->assertNotEmpty((new CommentModerator())->inspectText($text));
    }
}