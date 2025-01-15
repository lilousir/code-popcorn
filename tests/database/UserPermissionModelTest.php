<?php

namespace database;
use App\Models\UserPermissionModel;
use CodeIgniter\Test\CIUnitTestCase;

class UserPermissionModelTest extends CIUnitTestCase
{
    protected $userPermissionModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userPermissionModel = new UserPermissionModel();
    }

    // Test pour vérifier la création d'une permission
    public function testCreatePermission()
    {
        $data = [
            'name' => 'admin',
        ];

        $permissionId = $this->userPermissionModel->createPermission($data);
        $this->assertIsInt($permissionId);
        $this->assertGreaterThan(0, $permissionId);

        // Vérifie que la permission a bien été insérée dans la base de données
        $permission = $this->userPermissionModel->find($permissionId);
        $this->assertEquals($data['name'], $permission['name']);
        $this->assertNotEmpty($permission['slug']);
    }

    // Test pour vérifier la mise à jour d'une permission
    public function testUpdatePermission()
    {
        $data = [
            'name' => 'Manage Content',
        ];

        $permissionId = $this->userPermissionModel->createPermission($data);

        // Mise à jour de la permission
        $updatedData = [
            'name' => 'Manage Articles',
        ];
        $this->userPermissionModel->updatePermission($permissionId, $updatedData);

        // Vérifie que la permission a bien été mise à jour
        $permission = $this->userPermissionModel->find($permissionId);
        $this->assertEquals($updatedData['name'], $permission['name']);
    }

    // Test pour vérifier la suppression d'une permission
    public function testDeletePermission()
    {
        $data = [
            'name' => 'admin',
        ];

        $permissionId = $this->userPermissionModel->createPermission($data);

        // Supprimer la permission
        $this->userPermissionModel->deletePermission($permissionId);

        // Vérifie que la permission a bien été supprimée
        $permission = $this->userPermissionModel->find($permissionId);
        $this->assertNull($permission);
    }

    // Test pour récupérer toutes les permissions
    public function testGetAllPermissions()
    {
        $permissions = $this->userPermissionModel->getAllPermissions();
        $this->assertIsArray($permissions);
        $this->assertNotEmpty($permissions);
    }

    // Test de la récupération d'une permission par ID
    public function testGetUserPermissionById()
    {
        $data = [
            'name' => 'Manage Content',
        ];
        $permissionId = $this->userPermissionModel->createPermission($data);

        $permission = $this->userPermissionModel->getUserPermissionById($permissionId);
        $this->assertEquals($data['name'], $permission['name']);
    }

    // Test de la pagination des permissions
    public function testGetPaginatedPermission()
    {
        $permissions = $this->userPermissionModel->getPaginatedPermission(0, 5, '', 'name', 'asc');
        $this->assertIsArray($permissions);
        $this->assertCount(5, $permissions);
    }

    // Test de la recherche et filtrage des permissions
    public function testGetFilteredPermission()
    {
        $permissionsCount = $this->userPermissionModel->getFilteredPermission('Manage');
        $this->assertGreaterThan(0, $permissionsCount);
    }
}