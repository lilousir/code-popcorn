<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Showing extends BaseController
{

    public function getindex($id = null){

        $sm = model('ShowingModel');

        if ($id == null){
            $showing = $sm->findAll();

            return $this->view('admin/showing/index',['showing' => $showing], true);
        } else {
            $showing = model('ShowingModel')->getAllShowing();
            $movies = model('MovieModel')->getAllMovies();
            if ($id == "new"){
                return $this->view('admin/showing/showing', ['showing' => $showing, 'movies'=> $movies], true);
            }

            $showing = $sm->getShowingById($id);
           if ($showing){
             return $this->view("/admin/showing/showing", ['showing' => $showing], true);
           } else {
               // Si le cinéma avec cet ID n'existe pas, affiche un message d'erreur
               $this->error("L'ID de la séance n'existe pas");

               // Redirige l'utilisateur vers la liste des cinémas
               $this->redirect("/admin/showing");
           }
        }

    }

    public function postcreate()
    {
        $data = $this->request->getPost();
        $sm = Model("ShowingModel");

        // Créer l'utilisateur et obtenir son ID
        $newShowingId = $sm->createShowing($data);

        // Vérifier si la création a réussi
        if ($newShowingId) {
            $this->success("La séance à bien été ajouté.");
            $this->redirect("/admin/showing");
        } else {
            $errors = $sm->errors();
            foreach ($errors as $error) {
                $this->error($error);
                $this->redirect("/admin/showing/new");
            }

        }
    }
    public function postSearchShowing()
    {
        $showingModel = model('App\Models\ShowingModel');

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
        $data = $showingModel->getPaginatedShowing($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $showingModel->getTotalShowing();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $showingModel->getFilteredShowing($searchValue);


        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
    public function getdeactivate($id){
        $sm = Model('ShowingModel');
        if ($sm->deleteShowing($id)) {
            $this->success("Séance désactivé");
        } else {
            $this->error("Séance non désactivé");
        }
        $this->redirect('/admin/showing');
    }

    public function getactivate($id){
        $sm = Model('ShowingModel');
        if ($sm->activateShowing($id)) {
            $this->success("Séance activé");
        } else {
            $this->error("Séance non activé");
        }
        $this->redirect('/admin/showing');
    }

}
