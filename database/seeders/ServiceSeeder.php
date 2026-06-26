<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Service::create(['game' => 'Genshin Impact', 'category' => 'Single-Player', 'mitra_name' => 'Sarah Gaming', 'rating' => 4.9, 'reviews' => 120, 'title' => 'Eksplorasi Map 100% (Fontaine & Sumeru)', 'price' => 150000]);
        \App\Models\Service::create(['game' => 'Mobile Legends', 'category' => 'Kompetitif', 'mitra_name' => 'Gusion Joki', 'rating' => 4.8, 'reviews' => 85, 'title' => 'Joki Rank Epic ke Mythic (Paket Kilat)', 'price' => 200000]);
    }
}
