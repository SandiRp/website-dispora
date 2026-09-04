<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venues = [
            [
                'name' => 'Lapangan Jatim Seger',
                'short_description' => 'Fasilitas olahraga multifungsi untuk atlet dan masyarakat.',
                'description' => 'Lapangan Jatim Seger adalah fasilitas olahraga andalan Jawa Timur yang dirancang untuk mendukung berbagai aktivitas kebugaran, baik untuk atlet profesional maupun masyarakat umum.',
                'pic_name' => 'Budi Santoso',
                'pic_phone' => '6281234567890',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Lapangan Badminton',
                'short_description' => 'Lapangan bulu tangkis standar nasional dengan pencahayaan optimal.',
                'description' => 'Fasilitas lapangan badminton dengan karpet standar BWF, pencahayaan LED yang tidak menyilaukan, dan sirkulasi udara yang baik. Cocok untuk latihan dan pertandingan resmi.',
                'pic_name' => 'Rini Yulianti',
                'pic_phone' => '6281234567891',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Lapangan Tenis Meja',
                'short_description' => 'Arena tenis meja dalam ruangan dengan fasilitas lengkap.',
                'description' => 'Arena tenis meja yang dilengkapi dengan meja bersertifikat standar ITTF. Lantai anti-slip dan pencahayaan khusus dirancang untuk kenyamanan pemain.',
                'pic_name' => 'Agus Pratama',
                'pic_phone' => '6281234567892',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Dojo Karate',
                'short_description' => 'Pusat pelatihan bela diri Karate Jawa Timur.',
                'description' => 'Dojo Karate resmi yang difasilitasi dengan matras tatami standar kompetisi. Digunakan sebagai pusat pemusatan latihan atlet Karate Jawa Timur.',
                'pic_name' => 'Sensei Rahman',
                'pic_phone' => '6281234567893',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Dojo Judo',
                'short_description' => 'Fasilitas latihan Judo dengan matras berstandar internasional.',
                'description' => 'Dojo Judo yang aman dan nyaman, dilengkapi dengan sistem pegas di bawah matras untuk meminimalisir cedera saat bantingan.',
                'pic_name' => 'Sensei Tari',
                'pic_phone' => '6281234567894',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Gelanggang Atletik',
                'short_description' => 'Lintasan lari sintetis dan arena lompat/lempar.',
                'description' => 'Gelanggang Atletik berstandar IAAF dengan lintasan lari berbahan tartan sintetis. Tersedia juga fasilitas untuk lompat jauh, lompat tinggi, dan tolak peluru.',
                'pic_name' => 'Hendro Setiawan',
                'pic_phone' => '6281234567895',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'Kolam Renang',
                'short_description' => 'Kolam renang ukuran olimpiade untuk pembinaan akuatik.',
                'description' => 'Kolam renang berukuran olimpiade (50 meter) dengan 10 lintasan. Dilengkapi dengan kolam loncat indah dan sistem penyaringan air otomatis.',
                'pic_name' => 'Maya Sari',
                'pic_phone' => '6281234567896',
                'is_active' => true,
                'order' => 7,
            ],
        ];

        foreach ($venues as $venue) {
            \App\Models\Venue::create($venue);
        }
    }
}
