<?php

namespace Tests\database;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\CategoryModel;
use CodeIgniter\Test\DatabaseTestTrait;
class CategoryModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;
    protected $seed = 'App\Database\Seeds\DatabaseSeeder';
    protected $categoryModel;

    protected function setUp(): void
    {
        parent::setUp();

        // Instanciation du modèle
        $this->categoryModel = new CategoryModel();

        // Désactiver les clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Nettoyer la table `category`
        $this->db->table('category')->truncate();

        // Réactiver les clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');

        // Ajouter des données de test
        $this->db->table('category')->insertBatch([
            ['name' => 'Category 1', 'slug' => 'category-1'],
            ['name' => 'Category 2', 'slug' => 'category-2'],
            ['name' => 'Category 3', 'slug' => 'category-3'],
        ]);
    }

    public function testGetCategoryById()
    {
        $category = $this->categoryModel->getCategoryById(1);
        $this->assertEquals('Category 1', $category['name']);
    }

    public function testGetAllCategory()
    {
        $categories = $this->categoryModel->getAllCategory();
        $this->assertCount(3, $categories);
    }

    public function testCreateCategory()
    {
        $data = ['name' => 'New Category'];
        $id = $this->categoryModel->createCategory($data);
        $this->assertIsNumeric($id);

        $newCategory = $this->categoryModel->getCategoryById($id);
        $this->assertEquals('New Category', $newCategory['name']);
        $this->assertEquals('new-category', $newCategory['slug']);
    }

    public function testUpdateCategory()
    {
        $data = ['name' => 'Updated Category'];
        $this->categoryModel->updateCategory(1, $data);

        $updatedCategory = $this->categoryModel->getCategoryById(1);
        $this->assertEquals('Updated Category', $updatedCategory['name']);
        $this->assertEquals('updated-category', $updatedCategory['slug']);
    }

    public function testDeleteCategory()
    {
        $this->categoryModel->deleteCategory(1);
        $deletedCategory = $this->categoryModel->getCategoryById(1);
        $this->assertNull($deletedCategory);
    }

    public function testGetPaginatedCategory()
    {
        $categories = $this->categoryModel->getPaginatedCategory(0, 2, '', 'name', 'asc');
        $this->assertCount(2, $categories);
        $this->assertEquals('Category 1', $categories[0]['name']);
    }

    public function testGetFilteredCategory()
    {
        $categories = $this->categoryModel->getFilteredCategory('Category 1');
        $this->assertCount(1, $categories);
        $this->assertEquals('Category 1', $categories[0]['name']);
    }
}
