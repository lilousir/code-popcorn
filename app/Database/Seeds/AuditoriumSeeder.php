<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuditoriumSeeder extends Seeder
{
public function run()
{
$data = [
// Cinéma 21
[
'name' => 'Salle 1 - Le Cinéma Paradiso',
'capacity' => 200,
'theater_id' => 21,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - Le Grand Ecran',
'capacity' => 250,
'theater_id' => 21,
'deleted_at' => null,
],
[
'name' => 'Salle 3 - Vision 3D',
'capacity' => 180,
'theater_id' => 21,
'deleted_at' => null,
],
// Cinéma 22
[
'name' => 'Salle 1 - L’Elite Cinéma',
'capacity' => 220,
'theater_id' => 22,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - Cinema Lux',
'capacity' => 200,
'theater_id' => 22,
'deleted_at' => null,
],
[
'name' => 'Salle 3 - Cinéma Zenith',
'capacity' => 250,
'theater_id' => 22,
'deleted_at' => null,
],
// Cinéma 23
[
'name' => 'Salle 1 - Horizon Screen',
'capacity' => 150,
'theater_id' => 23,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - Cinéma Visionnaire',
'capacity' => 180,
'theater_id' => 23,
'deleted_at' => null,
],
[
'name' => 'Salle 3 - Grand Ecran IMAX',
'capacity' => 300,
'theater_id' => 23,
'deleted_at' => null,
],
// Cinéma 24
[
'name' => 'Salle 1 - Cinéma Royale',
'capacity' => 220,
'theater_id' => 24,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - Ecran Prestige',
'capacity' => 250,
'theater_id' => 24,
'deleted_at' => null,
],
[
'name' => 'Salle 3 - Cinéma Paradis',
'capacity' => 200,
'theater_id' => 24,
'deleted_at' => null,
],
// Cinéma 25
[
'name' => 'Salle 1 - Le Studio Cinéma',
'capacity' => 180,
'theater_id' => 25,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - La Cinémathèque',
'capacity' => 170,
'theater_id' => 25,
'deleted_at' => null,
],
[
'name' => 'Salle 3 - Ecran Zenith',
'capacity' => 230,
'theater_id' => 25,
'deleted_at' => null,
],
// Cinéma 26
[
'name' => 'Salle 1 - Le Cinéma Universel',
'capacity' => 200,
'theater_id' => 26,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - Cinéma Aurora',
'capacity' => 210,
'theater_id' => 26,
'deleted_at' => null,
],
// Cinéma 27
[
'name' => 'Salle 1 - Cinéma Galaxy',
'capacity' => 250,
'theater_id' => 27,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - Ecran Vision',
'capacity' => 220,
'theater_id' => 27,
'deleted_at' => null,
],
// Cinéma 28
[
'name' => 'Salle 1 - Le Cinéma Cinéphile',
'capacity' => 180,
'theater_id' => 28,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - Cinema Nova',
'capacity' => 190,
'theater_id' => 28,
'deleted_at' => null,
],
[
'name' => 'Salle 3 - Cinéma d’Or',
'capacity' => 200,
'theater_id' => 28,
'deleted_at' => null,
],
// Cinéma 29
[
'name' => 'Salle 1 - Le Cinéma Enchanté',
'capacity' => 210,
'theater_id' => 29,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - Cinéma Majestic',
'capacity' => 240,
'theater_id' => 29,
'deleted_at' => null,
],
[
'name' => 'Salle 3 - La Salle 3D',
'capacity' => 220,
'theater_id' => 29,
'deleted_at' => null,
],
// Cinéma 30
[
'name' => 'Salle 1 - Le Cinéma des Etoiles',
'capacity' => 200,
'theater_id' => 30,
'deleted_at' => null,
],
[
'name' => 'Salle 2 - Cinéma Céleste',
'capacity' => 230,
'theater_id' => 30,
'deleted_at' => null,
],
[
'name' => 'Salle 3 - Le Grand Cinéma',
'capacity' => 250,
'theater_id' => 30,
'deleted_at' => null,
]
];

// Insérer toutes les données dans la table 'auditorium'
$this->db->table('auditorium')->insertBatch($data);
}
}
