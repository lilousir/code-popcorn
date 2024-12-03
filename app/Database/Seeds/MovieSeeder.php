<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');
        $data = [];

        // Films spécifiques
        $specificMovies = [
            [
                'title'       => 'Harry Potter',
                'release_date'     => '2001-11-16',
                'duration'    => 152,
                'rating'      => 'Tous Publics',
                'slug'        => 'harry-potter',
                'description' => 'Un jeune garçon découvre qu\'il est un sorcier et entre dans une école de magie.',
            ],
            [
                'title'       => 'Ali G',
                'release_date'     => '2002-03-22',
                'duration'    => 85,
                'rating'      => '-16 ans',
                'slug'        => 'ali-g',
                'description' => 'Un jeune homme excentrique se retrouve mêlé à des affaires politiques malgré lui.',

            ],
            [
                'title'       => 'La Belle Verte',
                'release_date'     => '1996-09-18',
                'duration'    => 99,
                'rating'      => 'Tous Publics',
                'slug'        => 'la-belle-verte',
                'description' => 'Une extraterrestre visite la Terre pour comprendre les humains.',

            ],
        ];

        $data = array_merge($data, $specificMovies);

        // Générer les films restants
        $ratings = ['Tous Publics', '-12 ans', '-16 ans', '-18 ans'];

        for ($i = 0; $i < 147; $i++) {
            $title = $faker->catchPhrase;
            $data[] = [
                'title'       => $title,
                'release_date'     => $faker->date('Y-m-d', 'now'),
                'duration'    => random_int(60, 180), // Durée entre 1h et 3h
                'rating'      => $ratings[array_rand($ratings)],
                'slug'        => strtolower(str_replace(' ', '-', $title)),
                'description' => $faker->paragraph,

            ];
        }

        // Insérer les films dans la table movie
        $this->db->table('movies')->insertBatch($data);
    }
}
