<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Salle extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];


    public function getindex($id = null){
        $sm = model("SalleModel");


        // Vérifie si un ID est passé en paramètre
        if ($id == null) {
            // Si aucun ID n'est fourni, récupère tous les cinémas
            $salle = $sm->findAll();
            // Renvoie la vue listant les cinémas en passant les données récupérées
            return $this->view("/admin/salle/index.php", ['salle' => $salle], true);
        } else {
            // Si l'ID est égal à "new", cela signifie qu'un nouveau cinéma doit être créé
            $cinema = model("CinemaModel")->getAlltheater();
            if ($id == "new") {

                // Ajoute un breadcrumb pour indiquer la création d'un nouveau cinéma
                return $this->view("admin/salle/salle", ['cinema' => $cinema],true);

            }
            // Sinon, on suppose que l'ID correspond à un cinéma existant, récupère ses informations
            $salle = $sm->getSalleById($id);
            // Vérifie si le cinéma existe
            if ($salle) {
                // Ajoute un breadcrumb pour indiquer la modification du cinéma
                $this->addBreadcrumb('Modification de ' . $salle['name'], '');
                return $this->view("/admin/salle/salle", ["salle" => $salle, 'cinema'=>$cinema], true);

            } else {
                // Si le cinéma avec cet ID n'existe pas, affiche un message d'erreur
                $this->error("L'ID de la salle n'existe pas");

                // Redirige l'utilisateur vers la liste des cinémas
                $this->redirect("/admin/salle");
            }
        }
    }


    public function postcreate()
    {
        $data = $this->request->getPost();
        $sm = Model("SalleModel");

        // Créer l'utilisateur et obtenir son ID
        $newSalleId = $sm->createSalle($data);

        // Vérifier si la création a réussi
        if ($newSalleId) {
            $this->success("La salle à bien été ajouté.");
            $this->redirect("/admin/salle");
        } else {
            $errors = $sm->errors();
            foreach ($errors as $error) {
                $this->error($error);
                $this->redirect("/admin/movie/salle");
            }

        }
    }
    public function postupdate()
    {
        // Récupérer les données POST envoyées par le formulaire
        $data = $this->request->getPost();

        // Charger le modèle SalleModel
        $sm = Model("SalleModel");

        // Vérifier si l'identifiant (id) est présent dans les données
        if (!isset($data['id']) || empty($data['id'])) {
            // Gérer le cas où l'ID est manquant
            $this->redirect("/admin/salle")->with('error', 'Identifiant de la salle manquant.');
        }

        // Effectuer la mise à jour avec le modèle
        $isUpdated = $sm->updateSalle($data['id'], $data);

        // Vérifier si la mise à jour a réussi
        if ($isUpdated) {
            // Rediriger avec un message de succès
            $this->redirect("/admin/salle")->with('success', 'La salle a été mise à jour avec succès.');
        } else {
            // Rediriger avec un message d'erreur
            $this->redirect("/admin/salle")->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }




    public function postsearchsalle()
    {
        $SalleModel = model('App\Models\SalleModel');

        // Paramètres de pagination et de recherche envoyés par DataTables
        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Obtenez les informations sur le tri envoyées par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';


        // Obtenez les données triées et filtrées
        $data = $SalleModel-> getPaginatedSalle($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $SalleModel-> getTotalSalle();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $SalleModel-> getFilteredSalle($searchValue);


        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
    public function getdeactivate($id){
        $sm = Model('SalleModel');
        if ($sm->deleteSalle($id)) {
            $this->success("Salle désactivé");
        } else {
            $this->error("Salle non désactivé");
        }
        $this->redirect('/admin/salle');
    }

    public function getactivate($id){
        $sm = Model('SalleModel');
        if ($sm->activateSalle($id)) {
            $this->success("Salle activé");
        } else {
            $this->error("Salle non activé");
        }
        $this->redirect('/admin/salle');
    }


}