<?php

namespace Tests\Models;

use App\Models\MovieModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class MovieModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true; // Active la migration automatique
    protected $seed = 'App\Database\Seeds\DatabaseSeeder'; // Active le seeder, si nécessaire
    protected $movieModel;

    protected function setUp(): void
    {
        parent::setUp();

        // Charger le modèle
        $this->movieModel = new MovieModel();
    }

    public function testCreateMovie()
    {
        $data = [
            'title' => 'Test Movie',
            'release_date' => '2025-01-01',
            'duration' => '120',
            'rating' => '-16',
            'description' => 'This is a test movie',
        ];

        $movieId = $this->movieModel->createMovie($data);

        $this->assertIsInt($movieId); // Vérifie que l'ID est un entier
        $this->assertGreaterThan(0, $movieId); // L'ID doit être supérieur à 0

        $createdMovie = $this->movieModel->find($movieId);

        $this->assertNotEmpty($createdMovie); // Vérifie que le film a été créé
        $this->assertEquals($data['title'], $createdMovie['title']);
        $this->assertEquals($data['release_date'], $createdMovie['release_date']);
    }

    public function testGetMovieById()
    {
        // Insérer un film de test
        $data = [
            'title' => 'Test Movie 2',
            'release_date' => '2025-02-01',
            'duration' => '100',
            'rating' => '-12',
            'description' => 'Another test movie',
        ];
        $movieId = $this->movieModel->createMovie($data);

        $movie = $this->movieModel->getMovieById($movieId);

        $this->assertNotEmpty($movie);
        $this->assertEquals($data['title'], $movie['title']);
    }

    public function testUpdateMovie()
    {
        $model = new MovieModel();
        $data = [
            'title' => 'Test Movie to Update',
            'release_date' => '2025-03-01',
            'duration' =>'90' ,
            'rating' => '-18',
            'description' => 'Movie to be updated',
        ];
        $updatedData = [
            'title' => 'Updated Movie Title',
            'rating' => '-18',
        ];

        $model->createMovie($data); // Crée l'utilisateur pour le test
        $movie = $model->getMovieById(1); // Récupère l'utilisateur créé
        $model->updateMovie($movie['id'], $updatedData);
        // Mettre à jour le film


        $this->seeInDatabase('movies', ['title' => 'Updated Movie Title', 'rating' => '-18']);


    }

    public function testDeleteMovie()
    {
        // Insérer un film de test
        $data = [
            'title' => 'Test Movie to Delete',
            'release_date' => '2025-04-01',
            'duration' => 110,
            'rating' => -12,
            'description' => 'Movie to be deleted',
        ];
        $movieId = $this->movieModel->createMovie($data);

        // Supprimer le film
        $this->movieModel->deleteMovie($movieId);

        $deletedMovie = $this->movieModel->find($movieId);

        $this->assertNull($deletedMovie); // Vérifie que le film a été supprimé
    }

    public function testSearchMovieByName()
    {
        // Insérer un film de test
        $data = [
            'title' => 'Unique Search Test Movie',
            'release_date' => '2025-05-01',
            'duration' => 80,
            'rating' => -16,
            'description' => 'Movie for search test',
        ];
        $this->movieModel->createMovie($data);

        $searchResults = $this->movieModel->searchMovieByName('Search Test');

        $this->assertNotEmpty($searchResults);
        $this->assertEquals('Unique Search Test Movie', $searchResults[0]['title']);
    }
}
