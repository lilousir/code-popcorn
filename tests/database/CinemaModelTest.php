<?php

namespace Tests\database;
use CodeIgniter\Test\CIUnitTestCase;
use App\Models\CinemaModel;
use CodeIgniter\Test\DatabaseTestTrait;

class CinemaModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;
    protected $seed = 'App\Database\Seeds\DatabaseSeeder';
    protected $cinemaModel;

    protected function setUp(): void
    {
        parent::setUp();

        // Instanciation du modèle
        $this->cinemaModel = new CinemaModel();

        // Désactiver les clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Nettoyer la table `theater` et `media`
        $this->db->table('theater')->truncate();
        $this->db->table('media')->truncate();


        // Réactiver les clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');

        // Ajouter des données de test
        $this->db->table('city')->insert([
             'label' => 'Test City', 'zip_code' => '12345'
        ]);

        $this->db->table('theater')->insertBatch([
            ['name' => 'Cinema 1', 'address' => 'Address 1', 'phone' => '1234567890', 'email' => 'cinema1@example.com', 'id_city' => 1],
            ['name' => 'Cinema 2', 'address' => 'Address 2', 'phone' => '0987654321', 'email' => 'cinema2@example.com', 'id_city' => 1],
        ]);

        $this->db->table('media')->insertBatch([
            ['file_path' => 'path/to/photo1.jpg', 'entity_id' => 1, 'entity_type' => 'theater'],
            ['file_path' => 'path/to/photo2.jpg', 'entity_id' => 2, 'entity_type' => 'theater'],
        ]);
    }

    public function testGetAllMovieFiltered()
    {
        $movies = $this->cinemaModel->getAllMovieFiltered([], 5);
        $this->assertCount(2, $movies);
    }

    public function testGetAlltheater()
    {
        $theaters = $this->cinemaModel->getAlltheater();
        $this->assertCount(2, $theaters);
    }

    public function testGetTheatersById()
    {
        $theater = $this->cinemaModel->getTheatersById(1);
        $this->assertEquals('Cinema 1', $theater['name']);
    }

    public function testCreateCinema()
    {
        // Insérer un cinéma
        $data = [
            'name' => 'New Cinema',
            'address' => 'New Address',
            'phone' => '1112233445',
            'email' => 'newcinema@example.com',
            'id_city' => 1
        ];
        // Créer un cinéma
        $id = $this->cinemaModel->createCinema($data);

        // Vérifier si l'ID retourné est numérique
        $this->assertIsNumeric($id);

        // Vérifier que le cinéma créé existe
        $newCinema = $this->cinemaModel->getTheatersById($id);

        // Vérifier que le nom du cinéma correspond
        $this->assertEquals('New Cinema', $newCinema['name']);
    }

    public function testUpdateCinema()
    {
        // Insérer un cinéma fictif pour l'ID 1 si nécessaire
        $cinemaData = [
            'name' => 'Old Cinema',
            'address' => '123 Movie St',
            'phone' => '1234567890',
            'email' => 'oldcinema@example.com',
            'id_city' => 1,
        ];
        $this->cinemaModel->insert($cinemaData);  // Insertion du cinéma fictif

        // Mettre à jour le cinéma avec l'ID 1
        $data = ['name' => 'Updated Cinema'];
        $this->cinemaModel->updateCinema($data, 1);

        // Récupérer le cinéma mis à jour
        $updatedCinema = $this->cinemaModel->getTheatersById(1);

        // Vérifier que le nom a bien été mis à jour
        $this->assertEquals('Updated Cinema', $updatedCinema['name']);
    }


    public function testGetPaginatedCinema()
    {
        $cinemas = $this->cinemaModel->getPaginatedCinema(0, 1, '', 'name', 'asc');
        $this->assertCount(1, $cinemas);
        $this->assertEquals('Cinema 1', $cinemas[0]['name']);
    }

    public function testGetTotalCinema()
    {
        $total = $this->cinemaModel->getTotalCinema();
        $this->assertEquals(2, $total);
    }

    public function testGetFilteredCinema()
    {
        $cinemas = $this->cinemaModel->getFilteredCinema('Cinema');
        $this->assertCount(2, $cinemas);
    }
}
