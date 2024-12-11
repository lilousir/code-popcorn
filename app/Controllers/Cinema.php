<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Cinema extends BaseController
{
    protected $require_auth = false;
    public function getindex($id= null)
    {
        // Charger le modèle des cinémas
        $cm = model("CinemaModel");

        if($id === null){
            $data = $this->request->getGet();
            // Récupérer tous les cinémas

            $perPage = 8;
            $cinemas = $cm->getAllMovieFiltered($data,8, $perPage);
            $pager = $cm->pager;

            // Retourner la vue en passant les données
            return $this->view('cinema/cinemas', ['cinemas' => $cinemas,'pager' => $pager]);

        }

        $cinema = $cm->getTheatersById($id);

        if($cinema){
            return $this->view('cinema/cinema', ['cinema' => $cinema]);
        }


    }
}
