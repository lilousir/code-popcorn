<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Cinema extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];
    public function getIndex($id = null) {

        // Instancie le modèle pour gérer les cinémas.
        $cm = model("CinemaModel");

        // Vérifie si un ID est passé en paramètre
        if ($id == null) {
            // Si aucun ID n'est fourni, récupère tous les cinémas
            $cinemas = $cm->findAll();

            // Renvoie la vue listant les cinémas en passant les données récupérées
            return $this->view("/admin/cinema/index.php", ['cinemas' => $cinemas], true);
        } else {
            // Si l'ID est égal à "new", cela signifie qu'un nouveau cinéma doit être créé
            if ($id == "new") {
                $city = Model("CityModel")->getAllCity();
                // Ajoute un breadcrumb pour indiquer la création d'un nouveau cinéma
                return $this->view("admin/cinema/cinema", ['city' => $city],true);

            }
            // Sinon, on suppose que l'ID correspond à un cinéma existant, récupère ses informations
            $cinema = $cm->find($id);

            // Vérifie si le cinéma existe
            if ($cinema) {
                // Ajoute un breadcrumb pour indiquer la modification du cinéma
                $this->addBreadcrumb('Modification de ' . $cinema['name'], '');
                return $this->view("/admin/cinema/cinema", ["cinema" => $cinema], true);

            } else {
                // Si le cinéma avec cet ID n'existe pas, affiche un message d'erreur
                $this->error("L'ID du cinéma n'existe pas");

                // Redirige l'utilisateur vers la liste des cinémas
                $this->redirect("/admin/cinema");
            }
        }
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $cm = Model("CinemaModel");

        // Créer l'utilisateur et obtenir son ID
        $newCinemaId = $cm->createCinema($data);

        // Vérifier si la création a réussi
        if ($newCinemaId) {
            $this->success("Le cinema à bien été ajouté.");
            $this->redirect("/admin/cinema");
        } else {
            $errors = $cm->errors();
            foreach ($errors as $error) {
                $this->error($error);
                $this->redirect("/admin/cinema/new");
            }

        }
    }
    public function postupdate() {

    }
    public function postSearchCinema()
    {
        $CinemaModel = model('App\Models\CinemaModel');

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
        $data = $CinemaModel->getPaginatedCinema($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $CinemaModel->getTotalCinema();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $CinemaModel->getFilteredCinema($searchValue);


        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }

}