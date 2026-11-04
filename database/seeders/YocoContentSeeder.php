<?php

namespace Database\Seeders;

use App\Models\YocoContent;
use Illuminate\Database\Seeder;

class YocoContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);

        $contents = [
            [
                'type' => YocoContent::TYPE_SOSIALISASI,
                'title' => 'Sosialisasi Yoco pada INBIS UNAIR',
                'content' => 'Pengenalan peluang kewirausahaan, literasi usaha, akses program, dan praktik baik pada INBIS UNAIR',
                'image_path' => null,
                'link_url' => 'https://drive.google.com/drive/folders/1BboNY2D-Fz4tGvfwUv9YkFjHcx8Sx-JU',
                'link_label' => 'Lihat Detail',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'type' => YocoContent::TYPE_ADVOKASI,
                'title' => 'Dukungan Gubernur dalam pelaksanaan YOCO',
                'content' => 'Gubernur Jawa Timur sangat mendukung penuh dalam pelaksanaan YOCO, dengan Pendampingan aspirasi dan kebutuhan pelaku usaha muda agar terhubung dengan kebijakan, pembinaan, perizinan, permodalan, dan jejaring strategis.',
                'image_path' => null,
                'link_url' => 'https://drive.google.com/drive/folders/1Frynz35MN4aKbNz0t0KtoBTI2wPfy6eC',
                'link_label' => 'Selengkapnya',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'type' => YocoContent::TYPE_MARKETING,
                'title' => 'Siaran Pada JTV dengan Pembahasan YOCO',
                'content' => 'Pembahasan YOCO pada JTV.',
                'image_path' => null,
                'link_url' => 'https://drive.google.com/file/d/1Ll-C7mbTR7LcIOkS3nxb_kKx0Sp7MQzW/view',
                'link_label' => 'Tonton Selengkapnya',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'type' => YocoContent::TYPE_MARKETING,
                'title' => 'Penguatan Merek',
                'content' => 'Membangun identitas usaha yang relevan, profesional, dan terpercaya bagi konsumen modern.',
                'image_path' => null,
                'link_url' => null,
                'link_label' => 'Konsultasi Merek',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'type' => YocoContent::TYPE_MARKETING,
                'title' => 'Siaran TVRI Membahas YOCO',
                'content' => 'Pembahasan YOCO pada TVRI, mengenai bagaimana Jawa Timur mendorong potensi pemuda menjadi lebih baik',
                'image_path' => null,
                'link_url' => 'https://drive.google.com/file/d/1qYSUcBFxll10pvssZ3PCoLBbMoFVH6Lz/view',
                'link_label' => 'Tonton Selengkapnya',
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($contents as $data) {
            YocoContent::firstOrCreate(
                [
                    'type' => $data['type'],
                    'title' => $data['title'],
                ],
                $data
            );
        }
    }
}

