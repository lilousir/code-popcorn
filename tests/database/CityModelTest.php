<?php

namespace Tests\Support\Database;

use App\Models\CityModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class CityModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true; // Active la migration automatique
    protected $seed = 'App\Database\Seeds\DatabaseSeeder'; // Active le seeder, si nécessaire

    /**
     * Préparation avant chaque test
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Nettoyer la table `city`
        $this->db->table('city')->truncate();

        // Réactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Nettoyage après chaque test
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        // Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Nettoyer la table `city`
        $this->db->table('city')->truncate();

        // Réactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Test pour créer une ville
     */
    public function testCreateCity()
    {
        $cityModel = new CityModel();
        $data = [
            'label' => 'Paris',
            'zip_code' => '75000',
        ];

        $result = $cityModel->insert($data);

        // Vérifie que l'ID généré est valide (supérieur à 0)
        $this->assertTrue($result > 0);

        // Vérifie que la ville a bien été insérée en base de données
        $this->seeInDatabase('city', ['label' => 'Paris', 'zip_code' => '75000']);
    }

    /**
     * Test pour mettre à jour une ville
     */
    public function testUpdateCity()
    {
        $cityModel = new CityModel();

        // Créer une ville
        $data = [
            'label' => 'Lyon',
            'zip_code' => '69000',
        ];
        $cityId = $cityModel->insert($data);

        // Mettre à jour la ville
        $updatedData = [
            'label' => 'Lyon-Centre',
            'zip_code' => '69001',
        ];
        $cityModel->update($cityId, $updatedData);

        // Vérifie que les données ont été mises à jour
        $this->seeInDatabase('city', ['id' => $cityId, 'label' => 'Lyon-Centre', 'zip_code' => '69001']);
    }

    /**
     * Test pour supprimer une ville
     */
    public function testDeleteCity()
    {
        $cityModel = new CityModel();

        // Créer une ville
        $data = [
            'label' => 'Marseille',
            'zip_code' => '13000',
        ];
        $cityId = $cityModel->insert($data);

        // Supprimer la ville
        $cityModel->delete($cityId);

        // Vérifie que la ville a bien été supprimée
        $this->dontSeeInDatabase('city', ['id' => $cityId]);
    }

    /**
     * Test pour récupérer toutes les villes
     */
    public function testGetAllCity()
    {
        $cityModel = new CityModel();

        // Ajouter plusieurs villes
        $cityModel->insert(['label' => 'Bordeaux', 'zip_code' => '33000']);
        $cityModel->insert(['label' => 'Toulouse', 'zip_code' => '31000']);

        $cities = $cityModel->getAllCity();

        // Vérifie qu'il y a deux villes dans la base de données
        $this->assertCount(2, $cities);
    }

    /**
     * Test pour rechercher une ville par son nom ou son code postal
     */
    public function testSearchCityByName()
    {
        $cityModel = new CityModel();

        // Ajouter des villes pour le test
        $cityModel->insert(['label' => 'Nice', 'zip_code' => '06000']);
        $cityModel->insert(['label' => 'Nancy', 'zip_code' => '54000']);
        $cityModel->insert(['label' => 'Nantes', 'zip_code' => '44000']);

        // Recherche avec le mot-clé "Na"
        $result = $cityModel->searchCityByName('Na');

        // Vérifie que deux villes correspondent
        $this->assertCount(2, $result);

        // Vérifie que Nancy et Nantes sont dans les résultats
        $this->assertEquals('Nancy', $result[0]['label']);
        $this->assertEquals('Nantes', $result[1]['label']);
    }
}
