<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if hero properties already exist
        $existing = DB::table('heroproperties')->count();
        if ($existing > 0) {
            return; // Skip if data already exists
        }

        $heroProperties = [
            [
                'keyLine' => 'Design • Development • Marketing • E-commerce',
                'title' => 'Welcome to my portfolio',
                'short_title' => 'Musabe Coucou',
                'img' => 'assets/m12.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('heroproperties')->insert($heroProperties);
    }
}