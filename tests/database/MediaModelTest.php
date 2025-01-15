<?php

namespace Tests\Support\Database;

use App\Models\MediaModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class MediaModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true; // Active les migrations automatiques
    protected $seed = 'App\Database\Seeds\DatabaseSeeder'; // Utilisez votre seeder si nécessaire

    /**
     * Préparation avant chaque test
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Nettoyer la table `media`
        $this->db->table('media')->truncate();

        // Réactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Test pour insérer un média
     */
    public function testCreateMedia()
    {
        $mediaModel = new MediaModel();
        $data = [
            'file_path' => 'uploads/images/sample.jpg',

            'entity_id' => 1,
            'entity_type' => 'post',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $result = $mediaModel->insert($data);

        // Vérifie que l'ID généré est valide (supérieur à 0)
        $this->assertTrue($result > 0);

        // Vérifie que le média a bien été inséré en base de données
        $this->seeInDatabase('media', ['file_path' => 'uploads/images/sample.jpg']);
    }

    /**
     * Test pour récupérer un média par son ID
     */
    public function testGetMediaById()
    {
        $mediaModel = new MediaModel();

        // Ajouter un média
        $data = [
            'file_path' => 'uploads/images/test.jpg',

            'entity_id' => 1,
            'entity_type' => 'user',
        ];
        $mediaId = $mediaModel->insert($data);

        // Récupérer le média
        $media = $mediaModel->getMediaById($mediaId);

        $this->assertNotEmpty($media);
        $this->assertEquals('uploads/images/test.jpg', $media['file_path']);
    }

    /**
     * Test pour supprimer un média
     */
    public function testDeleteMedia()
    {
        $mediaModel = new MediaModel();

        // Ajouter un média
        $data = [
            'file_path' => 'uploads/files/delete_me.txt',

            'entity_id' => 2,
            'entity_type' => 'document',
        ];
        $mediaId = $mediaModel->insert($data);

        // Créer un faux fichier pour simuler la suppression physique
        $filePath = FCPATH . 'uploads/files/delete_me.txt';
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }
        file_put_contents($filePath, 'Sample content.');

        // Supprimer le média
        $result = $mediaModel->deleteMedia($mediaId);

        // Vérifie que le média a été supprimé
        $this->assertTrue($result);
        $this->dontSeeInDatabase('media', ['id' => $mediaId]);

        // Vérifie que le fichier a été supprimé
        $this->assertFalse(file_exists($filePath));
    }

    /**
     * Test pour récupérer tous les médias d'un type d'entité
     */
    public function testGetAllMediasByEntityType()
    {
        $mediaModel = new MediaModel();

        // Ajouter des médias
        $mediaModel->insert(['file_path' => 'uploads/images/1.jpg','entity_id' => 1, 'entity_type' => 'post']);
        $mediaModel->insert(['file_path' => 'uploads/images/2.jpg', 'entity_id' => 2, 'entity_type' => 'post']);
        $mediaModel->insert(['file_path' => 'uploads/documents/1.pdf', 'entity_id' => 1, 'entity_type' => 'document']);

        $medias = $mediaModel->getAllMediasByEntityType('post');

        // Vérifie qu'il y a deux médias pour le type 'post'

    }

    /**
     * Test pour récupérer un média par son entité ID et type
     */
    public function testGetMediaByEntityIdAndType()
    {
        $mediaModel = new MediaModel();

        // Ajouter des médias

        $mediaModel->insert(['file_path' => 'uploads/images/img1.jpg','entity_id' => 3, 'entity_type' => 'image']);

        $medias = $mediaModel->getMediaByEntityIdAndType(3, 'video');

        // Vérifie qu'il y a deux vidéos pour l'entité ID 3
        $this->assertCount(2, $medias);
    }

    /**
     * Test pour récupérer le premier média par son entité ID et type
     */
    public function testGetFirstMediaByEntityIdAndType()
    {
        $mediaModel = new MediaModel();

        // Ajouter des médias
        $mediaModel->insert(['file_path' => 'uploads/photos/photo1.jpg', 'entity_id' => 4, 'entity_type' => 'gallery']);
        $mediaModel->insert(['file_path' => 'uploads/photos/photo2.jpg', 'entity_id' => 4, 'entity_type' => 'gallery']);

        $media = $mediaModel->getFirstMediaByEntityIdAndType(4, 'gallery');

        // Vérifie que le premier média est bien retourné

        $this->assertEquals('uploads/photos/photo1.jpg', $media['file_path']);
    }
}
