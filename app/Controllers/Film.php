<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Film extends BaseController
{
    protected $require_auth = false;


    public function getindex($slug = null)
    {
        $mm = model("MovieModel");

        if ($slug === null) {
            $data = $this->request->getGet();
            // Récupère tous les films

            $perPage = 8;
            $movies = $mm->getAllMovieFiltered($data,12, $perPage);
            $pager = $mm->pager;
            return $this->view('film/movies', [
                'movies' => $movies,
                'pager' => $pager

            ]);

        }

        // Récupère un film par son slug
        $movie = $mm->getMovieBySlug($slug);
        $cinema = model("CinemaModel")->getAlltheater();
        $showing = model("ShowingModel")->getShowingByMovieSlug($slug);
        if($movie){
        return $this->view('film/film', [
            'movie' => $movie, 'cinema' => $cinema, 'showing'=> $showing

        ]);
        }
    }




    public function getautocompleteMovie() {
        $searchValue = $this->request->getGet('q');

        $movieModel = model("MovieModel");

        // Recherche des films par nom
        $movies = $movieModel->searchMovieByName($searchValue);

        // Formatage des résultats pour Select2
        $results = [];
        foreach ($movies as $movie) {
            $results[] = [
                'id' => $movie['slug'],
                'text' => $movie['title']
            ];
        }

        // Retourne les résultats au format JSON
        return $this->response->setJSON($results);
    }
}