<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Film extends BaseController
{
    protected $require_auth = false;  // Cette propriété indique que l'authentification n'est pas requise pour accéder à ce contrôleur.

    /**
     * Méthode pour afficher la liste des films ou les détails d'un film spécifique en fonction du slug.
     *
     * @param string|null $slug Le slug du film à afficher (si fourni)
     * @return \CodeIgniter\HTTP\Response Vue contenant la liste des films ou les détails d'un film spécifique
     */
    public function getindex($slug = null)
    {
        // Charger le modèle des films pour interagir avec la base de données
        $mm = model("MovieModel");

        // Si aucun slug n'est fourni, afficher la liste des films
        if ($slug === null) {
            // Récupérer les paramètres GET envoyés par la requête
            $data = $this->request->getGet();

            // Définir le nombre de films à afficher par page
            $perPage = 8;

            // Récupérer les films filtrés (en fonction des données de la requête) avec la pagination
            $movies = $mm->getAllMovieFiltered($data, 12, $perPage);

            // Récupérer l'objet pager pour la pagination
            $pager = $mm->pager;

            // Retourner la vue avec la liste des films et les informations de pagination
            return $this->view('film/movies', ['movies' => $movies, 'pager' => $pager ]);



        }

        // Si un slug de film est fourni, afficher les détails du film correspondant
        $movie = $mm->getMovieBySlug($slug);

        // Récupérer la liste de tous les cinémas
        $cinema = model("CinemaModel")->getAlltheater();

        // Récupérer les séances de film correspondantes au slug du film
        $showing = model("ShowingModel")->getShowingByMovieSlug($slug);

        // Si un film correspondant au slug est trouvé, retourner la vue avec les détails du film
        if ($movie) {
            return $this->view('film/film', ['movie' => $movie,'cinema' => $cinema,'showing' => $showing ]);




        }

        // Si aucun film n'est trouvé pour ce slug, aucune vue n'est retournée (il pourrait être utile d'ajouter un message d'erreur ou une redirection)
    }

    /**
     * Méthode pour autocompléter la recherche de films en fonction d'une valeur de recherche.
     *
     * @return \CodeIgniter\HTTP\Response Liste des films correspondants à la recherche
     */
    public function getautocompleteMovie()
    {
        // Récupérer la valeur de recherche envoyée par la requête
        $searchValue = $this->request->getGet('q');

        // Charger le modèle des films
        $movieModel = model("MovieModel");

        // Rechercher les films par nom qui correspondent à la valeur de recherche
        $movies = $movieModel->searchMovieByName($searchValue);

        // Formatage des résultats pour Select2 (un plugin JavaScript pour les listes déroulantes)
        $results = [];
        foreach ($movies as $movie) {
            $results[] = [
                'id' => $movie['slug'],  // Identifiant du film (utilisé comme valeur dans le select)
                'text' => $movie['title']  // Texte affiché dans la liste déroulante
            ];
        }

        // Retourner les résultats au format JSON pour l'interface front-end
        return $this->response->setJSON($results);
    }
}
