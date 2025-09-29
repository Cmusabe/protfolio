<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectProgrammingLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Project-programming language relaties
        $projectLanguages = [
            // House of Lush (Project ID 1)
            ['project_id' => 1, 'programming_language_id' => 1, 'created_at' => now(), 'updated_at' => now()], // PHP
            ['project_id' => 1, 'programming_language_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Laravel
            ['project_id' => 1, 'programming_language_id' => 5, 'created_at' => now(), 'updated_at' => now()], // HTML5
            ['project_id' => 1, 'programming_language_id' => 6, 'created_at' => now(), 'updated_at' => now()], // CSS3
            ['project_id' => 1, 'programming_language_id' => 7, 'created_at' => now(), 'updated_at' => now()], // WordPress
            
            // Despit Hold (Project ID 2)
            ['project_id' => 2, 'programming_language_id' => 1, 'created_at' => now(), 'updated_at' => now()], // PHP
            ['project_id' => 2, 'programming_language_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Laravel
            ['project_id' => 2, 'programming_language_id' => 3, 'created_at' => now(), 'updated_at' => now()], // JavaScript
            ['project_id' => 2, 'programming_language_id' => 5, 'created_at' => now(), 'updated_at' => now()], // HTML5
            ['project_id' => 2, 'programming_language_id' => 6, 'created_at' => now(), 'updated_at' => now()], // CSS3
            
            // Nieuwspitholt (Project ID 3)
            ['project_id' => 3, 'programming_language_id' => 1, 'created_at' => now(), 'updated_at' => now()], // PHP
            ['project_id' => 3, 'programming_language_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Laravel
            ['project_id' => 3, 'programming_language_id' => 3, 'created_at' => now(), 'updated_at' => now()], // JavaScript
            ['project_id' => 3, 'programming_language_id' => 4, 'created_at' => now(), 'updated_at' => now()], // React
            ['project_id' => 3, 'programming_language_id' => 5, 'created_at' => now(), 'updated_at' => now()], // HTML5
            ['project_id' => 3, 'programming_language_id' => 6, 'created_at' => now(), 'updated_at' => now()], // CSS3
            
            // Romys Touch (Project ID 4)
            ['project_id' => 4, 'programming_language_id' => 1, 'created_at' => now(), 'updated_at' => now()], // PHP
            ['project_id' => 4, 'programming_language_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Laravel
            ['project_id' => 4, 'programming_language_id' => 5, 'created_at' => now(), 'updated_at' => now()], // HTML5
            ['project_id' => 4, 'programming_language_id' => 6, 'created_at' => now(), 'updated_at' => now()], // CSS3
            ['project_id' => 4, 'programming_language_id' => 9, 'created_at' => now(), 'updated_at' => now()], // Bootstrap
            
            // Egwebsolutions (Project ID 5)
            ['project_id' => 5, 'programming_language_id' => 1, 'created_at' => now(), 'updated_at' => now()], // PHP
            ['project_id' => 5, 'programming_language_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Laravel
            ['project_id' => 5, 'programming_language_id' => 3, 'created_at' => now(), 'updated_at' => now()], // JavaScript
            ['project_id' => 5, 'programming_language_id' => 4, 'created_at' => now(), 'updated_at' => now()], // React
            ['project_id' => 5, 'programming_language_id' => 5, 'created_at' => now(), 'updated_at' => now()], // HTML5
            ['project_id' => 5, 'programming_language_id' => 6, 'created_at' => now(), 'updated_at' => now()], // CSS3
            ['project_id' => 5, 'programming_language_id' => 8, 'created_at' => now(), 'updated_at' => now()], // MySQL
            ['project_id' => 5, 'programming_language_id' => 10, 'created_at' => now(), 'updated_at' => now()], // Git
            
            // Oliviwilson (Project ID 6)
            ['project_id' => 6, 'programming_language_id' => 1, 'created_at' => now(), 'updated_at' => now()], // PHP
            ['project_id' => 6, 'programming_language_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Laravel
            ['project_id' => 6, 'programming_language_id' => 3, 'created_at' => now(), 'updated_at' => now()], // JavaScript
            ['project_id' => 6, 'programming_language_id' => 4, 'created_at' => now(), 'updated_at' => now()], // React
            ['project_id' => 6, 'programming_language_id' => 5, 'created_at' => now(), 'updated_at' => now()], // HTML5
            ['project_id' => 6, 'programming_language_id' => 6, 'created_at' => now(), 'updated_at' => now()], // CSS3
            ['project_id' => 6, 'programming_language_id' => 9, 'created_at' => now(), 'updated_at' => now()], // Bootstrap
        ];

        DB::table('project_programming_language')->insert($projectLanguages);
    }
}
