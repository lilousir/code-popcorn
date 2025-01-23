<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Userpermission extends BaseController
{
    protected $require_auth = true;  // La page nécessite une authentification
    protected $requiredPermissions = ['administrateur']; // Seuls les utilisateurs avec le rôle 'administrateur' peuvent accéder

    // Méthode principale pour afficher les permissions des utilisateurs
    public function getindex($id = null) {
        if ($id == null) {
            return $this->view('/admin/user/index-permission', [], true);  // Affiche la vue des permissions
        } else {
            $upm = Model("/UserPermissionModel");
            if ($id == "new") {
                return $this->view('/admin/user/user-permission', [], true);  // Affiche la vue pour créer une nouvelle permission
            }
            $permission = $upm->getUserPermissionById($id);  // Récupère la permission par ID
            return $this->view('/admin/user/user-permission', ["permission" => $permission], true);
        }
    }

    // Méthode pour mettre à jour une permission
    public function postupdate() {
        $data = $this->request->getPost();  // Récupère les données envoyées en POST
        $upm = Model("/UserPermissionModel");
        if ($upm->updatePermission($data['id'], $data)) {
            $this->success("Permission à bien été modifié");  // Message de succès
        } else {
            $this->error("Une erreur est survenue");  // Message d'erreur
        }
        $this->redirect("/admin/userpermission");  // Redirige vers la liste des permissions
    }

    // Méthode pour créer une nouvelle permission
    public function postcreate() {
        $data = $this->request->getPost();  // Récupère les données envoyées en POST
        $upm = Model("UserPermissionModel");
        if ($upm->createPermission($data)) {
            $this->success("Le rôle à bien été ajouté.");  // Message de succès
            $this->redirect("/admin/userpermission");  // Redirige vers la liste des permissions
        } else {
            $errors = $upm->errors();  // Récupère les erreurs s'il y en a
            foreach ($errors as $error) {
                $this->error($error);  // Affiche chaque erreur
            }
            $this->redirect("/admin/userpermission/new");  // Redirige vers la page de création en cas d'erreur
        }
    }

    // Méthode pour supprimer une permission
    public function getdelete($id){
        $upm = Model('UserPermissionModel');
        if ($upm->deletePermission($id)) {
            $this->success("Rôle supprimé");  // Message de succès
        } else {
            $this->error("Rôle non supprimé");  // Message d'erreur
        }
        $this->redirect('/admin/userpermission');  // Redirige vers la liste des permissions
    }

    // Méthode pour rechercher des permissions avec pagination
    public function postSearchPermission()
    {
        $UserModel = model('App\Models\UserPermissionModel');

        // Paramètres envoyés par DataTables pour la pagination et la recherche
        $draw = $this->request->getPost('draw');
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Récupère les informations sur le tri envoyé par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'];
        $orderDirection = $this->request->getPost('order')[0]['dir'];
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'];

        // Récupère les données triées et filtrées
        $data = $UserModel->getPaginatedPermission($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Récupère le nombre total de lignes sans filtre
        $totalRecords = $UserModel->getTotalPermission();

        // Récupère le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $UserModel->getFilteredPermission($searchValue);

        // Prépare la réponse JSON pour DataTables
        $result = [
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ];

        return $this->response->setJSON($result);  // Retourne le résultat au format JSON
    }
}
