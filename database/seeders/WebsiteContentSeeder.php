<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WebsiteContentSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@solusinetnusantara.id'],
            [
                'name' => 'Admin SNN',
                'password' => 'password',
                'role' => 'admin',
                'phone' => '081234567890',
            ]
        );

        User::updateOrCreate(
            ['email' => 'member@example.com'],
            [
                'name' => 'Member Contoh',
                'password' => 'password',
                'role' => 'member',
                'phone' => '081111111111',
            ]
        );

        $products = [
            [
                'name' => 'Paket Promo 20 Mbps',
                'slug' => Str::slug('Paket Promo 20 Mbps'),
                'description' => 'Paket hemat untuk rumah dan UMKM dengan kecepatan stabil hingga 20 Mbps.',
                'price' => 149000,
                'speed' => 'Kecepatan internet hingga 20 Mbps',
                'features' => "Kuota tidak terbatas\nGratis instalasi dasar\nSupport teknis jam kerja\nCocok untuk streaming & WFH",
                'image' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Paket Reguler 40 Mbps',
                'slug' => Str::slug('Paket Reguler 40 Mbps'),
                'description' => 'Paket populer untuk keluarga dan bisnis kecil dengan performa seimbang.',
                'price' => 229000,
                'speed' => 'Kecepatan internet hingga 40 Mbps',
                'features' => "Kuota tidak terbatas\nPrioritas traffic ringan\nFree maintenance 1x/bulan\nSupport chat cepat",
                'image' => null,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Paket Puas 100 Mbps',
                'slug' => Str::slug('Paket Puas 100 Mbps'),
                'description' => 'Paket premium untuk kebutuhan multi-device, konferensi, dan operasional kantor.',
                'price' => 349000,
                'speed' => 'Kecepatan internet hingga 100 Mbps',
                'features' => "Kuota tidak terbatas\nGratis 1 bulan pertama\nPrioritas support 24/7\nInstallasi jaringan lanjutan",
                'image' => null,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }

        $galleries = [
            [
                'title' => 'Instalasi WiFi Kantor',
                'description' => 'Proses pemasangan access point dan optimasi coverage di area kantor klien.',
                'image' => null,
                'category' => 'instalasi',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Penataan Kabel Jaringan',
                'description' => 'Teknisi melakukan manajemen kabel rapi agar mudah maintenance.',
                'image' => null,
                'category' => 'jaringan',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Tim Lapangan SNN',
                'description' => 'Foto bersama tim sebelum melaksanakan pemasangan di lokasi baru.',
                'image' => null,
                'category' => 'tim',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Survey Lokasi Pelanggan',
                'description' => 'Kegiatan survey untuk menentukan jalur kabel dan posisi router ideal.',
                'image' => null,
                'category' => 'instalasi',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Kantor Pusat SNN',
                'description' => 'Area kerja admin dan technical support PT Solusi Net Nusantara.',
                'image' => null,
                'category' => 'kantor',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Teknisi',
                'description' => 'Materi internal untuk meningkatkan kualitas layanan pelanggan.',
                'image' => null,
                'category' => 'acara',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::updateOrCreate(
                ['title' => $gallery['title'], 'category' => $gallery['category']],
                $gallery
            );
        }
    }
}
