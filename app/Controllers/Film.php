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
            $movies = $mm->getAllUmovies();
            $perPage = 8;
            $allmovie = $mm->getAllMovieFiltered($data, 1, $perPage);

            return $this->view('film/movies', [
                'movies' => $movies,
                'allmovies' => $allmovie
            ]);
        }

        // Récupère un film par son slug
        $movie = $mm->getMovieBySlug($slug);

        if($movie){
        return $this->view('film/film', [
            'movie' => $movie,

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
                'text' => $movie['name']
            ];
        }

        // Retourne les résultats au format JSON
        return $this->response->setJSON($results);
    }
}