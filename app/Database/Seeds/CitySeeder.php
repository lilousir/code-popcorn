<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $city = [
            ['name' => 'Marseille', 'zip' => '13000'],
            ['name' => 'Lyon', 'zip' => '69000'],
            ['name' => 'Toulouse', 'zip' => '31000'],
            ['name' => 'Nice', 'zip' => '06000'],
            ['name' => 'Nantes', 'zip' => '44000'],
            ['name' => 'Strasbourg', 'zip' => '67000'],
            ['name' => 'Montpellier', 'zip' => '34000'],
            ['name' => 'Bordeaux', 'zip' => '33000'],
            ['name' => 'Lille', 'zip' => '59000'],
            // Ajoutez d'autres villes si nécessaire...
        ];

        // Insérer les données dans la table 'cities'
        $this->db->table('city')->insertBatch($city);
    }
}
