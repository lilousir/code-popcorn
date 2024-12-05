<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CinemaSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');

        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'name'      => $faker->company . ' Cinéma',
                'address'   => $faker->address,
                'phone'     => $faker->phoneNumber,
                'email'     => $faker->companyEmail,
                'city_id'   => random_int(1, 35076),
                'deleted_at'=> null,
            ];
        }

        // Insert batch
        $this->db->table('theater')->insertBatch($data);
    }
}