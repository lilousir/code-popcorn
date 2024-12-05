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
                'description' => 'Un jeune garçon découvre qu\'il est un sorcier et entre dans une école de magie.',
                'slug'        => 'harry-potter',
                'rating'      => 'Tous Publics',

            ],
            [
                'title'       => 'Ali G',
                'release_date'     => '2002-03-22',
                'duration'    => 85,
                'description' => 'Un jeune homme excentrique se retrouve mêlé à des affaires politiques malgré lui.',
                'slug'        => 'ali-g',
                'rating'      => '-16',

            ],
            [
                'title'       => 'La Belle Verte',
                'release_date'     => '1996-09-18',
                'duration'    => 99,
                'description' => 'Une extraterrestre visite la Terre pour comprendre les humains.',
                'slug'        => 'la-belle-verte',
                'rating'      => 'Tous Publics',

            ],
        ];

        $data = array_merge($data, $specificMovies);

        // Générer les films restants
        $ratings = ['Tous Publics', '-12', '-16', '-18'];

        for ($i = 0; $i < 147; $i++) {
            $title = $faker->catchPhrase;
            $data[] = [
                'title'       => $title,
                'release_date'     => $faker->date('Y-m-d', 'now'),
                'duration'    => random_int(60, 180), // Durée entre 1h et 3h
                'description' => $faker->paragraph,
                'slug'        => strtolower(str_replace(' ', '-', $title)),
                'rating'      => $ratings[array_rand($ratings)],

            ];
        }

        // Insérer les films dans la table movie
        $this->db->table('movies')->insertBatch($data);
    }
}
