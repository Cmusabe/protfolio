<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'House of Lush',
                'previewLink' => 'https://houseoflush.nl/',
                'thumbLink' => 'assets/houseoflush.png',
                'details' => 'Een moderne website voor een beauty salon gespecialiseerd in haarverlenging en styling. De website bevat een portfolio, prijslijst en online afspraak systeem.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Despit Hold',
                'previewLink' => 'https://despithold.nl/',
                'thumbLink' => 'assets/despithold.png',
                'details' => 'Website voor een biologisch melkveebedrijf in Almen. Toont de duurzame landbouwmethoden en biologische producten van het bedrijf.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Nieuwspitholt',
                'previewLink' => 'https://nieuwspitholt.nl/',
                'thumbLink' => 'assets/Nieuwspitholt.png',
                'details' => 'Logement website voor een rustieke accommodatie in de natuur. Bevat boekingssysteem en informatie over lokale activiteiten.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Romys Touch',
                'previewLink' => 'https://www.romystouch.nl/',
                'thumbLink' => 'assets/romystouch.png',
                'details' => 'Nagelstudio website met portfolio van nagelkunst en behandelingsopties. Modern design met focus op visuele presentatie.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Egwebsolutions',
                'previewLink' => 'https://www.egwebsolutions.nl/',
                'thumbLink' => 'assets/Egwebsolutions.png',
                'details' => 'Corporate website voor een web development bedrijf. Toont diensten, portfolio en contact informatie voor digitale transformatie.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Oliviwilson',
                'previewLink' => 'https://oliviwilson.nl/',
                'thumbLink' => 'assets/oliviwilson.png',
                'details' => 'Fashion blog en portfolio website voor een mode-influencer. Bevat lifestyle content, outfit inspiratie en persoonlijke verhalen.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('projects')->insert($projects);
    }
}
