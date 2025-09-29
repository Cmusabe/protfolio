<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgrammingLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'name' => 'PHP',
                'color_code' => '#777BB4',
                'icon' => 'fab fa-php',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laravel',
                'color_code' => '#FF2D20',
                'icon' => 'fab fa-laravel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'JavaScript',
                'color_code' => '#F7DF1E',
                'icon' => 'fab fa-js-square',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'React',
                'color_code' => '#61DAFB',
                'icon' => 'fab fa-react',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HTML5',
                'color_code' => '#E34F26',
                'icon' => 'fab fa-html5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CSS3',
                'color_code' => '#1572B6',
                'icon' => 'fab fa-css3-alt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'WordPress',
                'color_code' => '#21759B',
                'icon' => 'fab fa-wordpress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MySQL',
                'color_code' => '#4479A1',
                'icon' => 'fas fa-database',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bootstrap',
                'color_code' => '#7952B3',
                'icon' => 'fab fa-bootstrap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Git',
                'color_code' => '#F05032',
                'icon' => 'fab fa-git-alt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('programming_languages')->insert($languages);
    }
}
