<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Showing extends BaseController
{

    public function getindex(){

        $showing = model('ShowingModel')->getAllShowing();
        return $this->view('admin/showing/index',['showing' => $showing], true);
    }
    public function postsearchshowing()
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
        if ($sm->deleteSalle($id)) {
            $this->success("Salle désactivé");
        } else {
            $this->error("Salle non désactivé");
        }
        $this->redirect('/admin/salle');
    }

    public function getactivate($id){
        $sm = Model('ShowingModel');
        if ($sm->activateSalle($id)) {
            $this->success("Salle activé");
        } else {
            $this->error("Salle non activé");
        }
        $this->redirect('/admin/salle');
    }


}