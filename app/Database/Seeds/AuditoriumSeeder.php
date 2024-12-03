<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuditoriumSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');
        $data = [];

        for ($theaterId = 1; $theaterId <= 20; $theaterId++) {
            // Générer un nombre aléatoire de salles par cinéma (entre 3 et 12)
            $numberOfAuditoriums = random_int(3, 12);

            for ($i = 0; $i < $numberOfAuditoriums; $i++) {
                $data[] = [
                    'name'       => 'Salle ' . $faker->word,
                    'capacity'   => random_int(50, 300), // Capacité aléatoire entre 50 et 300
                    'theater_id' => $theaterId,
                    'deleted_at' => null,
                ];
            }
        }

        // Insérer toutes les données dans la table auditorium
        $this->db->table('auditorium')->insertBatch($data);
    }
}