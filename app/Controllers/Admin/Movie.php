<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Movie extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];

    public function getindex($id = null)
    {
        $mm = model("MovieModel");
        $cm = model('CategoryModel'); // Charge le modèle des catégories
        $cmm = model("CategoryMovieModel");
        $categorys = $cm->getAllCategory(); // Récupère toutes les catégories


        // Vérifie si un ID est passé en paramètre
        if ($id == null) {
            // Si aucun ID n'est fourni, récupère tous les films
            $movies = $mm->findAll();

            // Renvoie la vue listant les films en passant les données récupérées
            return $this->view("/admin/movie/index.php", ['cinemas' => $movies, 'category' => $categorys], true);
        } else {
            // Si l'ID est égal à "new", cela signifie qu'un nouveau film doit être créé
            if ($id == "new") {
                return $this->view("admin/movie/movie", ['category' => $categorys], true);
            }

            // Sinon, on suppose que l'ID correspond à un film existant
            $movies = $mm->find($id);
            $categoriesForMovie = $cmm->getAllFullMovieCategorieByIdMovie($id); // Récupère les catégories liées au film

            // Vérifie si le film existe
            if ($movies) {
                // Ajoute un breadcrumb pour indiquer la modification du film
                $this->addBreadcrumb('Modification de ' . $movies['title'], '');
                return $this->view("/admin/movie/movie", [
                    "movie" => $movies,
                    'category' => $categorys,
                    'categoriesForMovie' => $categoriesForMovie
                ], true);
            } else {
                // Si le film avec cet ID n'existe pas, affiche un message d'erreur
                $this->error("L'ID du film n'existe pas");
                $this->redirect("/admin/movie"); // Redirige vers la liste des films
            }
        }
    }



    public function postcreate()
    {
        $data = $this->request->getPost();
        $cm = Model("MovieModel");

        // Créer l'utilisateur et obtenir son ID
        $newMovieId = $cm->createMovie($data);

        // Vérifier si la création a réussi
        if ($newMovieId) {
            $this->success("Le film à bien été ajouté.");
            $this->redirect("/admin/movie");
        } else {
            $errors = $cm->errors();
            foreach ($errors as $error) {
                $this->error($error);
                $this->redirect("/admin/movie/new");
            }

        }

    }

    public function postupdate()
    {
        // Récupération des données envoyées via POST
        $data = $this->request->getPost();

        // Récupération du modèle UserModel
        $mm = Model("MovieModel");

        // Mise à jour des informations utilisateur dans la base de données
        if ($mm->updateMovie($data['id'], $data)) {
            // Si la mise à jour réussit
            $this->success("Le film a bien été modifié.");
        } else {
            $errors = $mm->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
        }

        // Redirection vers la page des films après le traitement
        return $this->redirect("/admin/movie");
    }





    public function postSearchMovies()
    {
        $MovieModel = model('App\Models\MovieModel');

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
        $data = $MovieModel-> getPaginatedMovie($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $MovieModel-> getTotalMovie();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $MovieModel-> getFilteredMovie($searchValue);


        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }

}