<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Movie extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];

public function getindex($id = null){

//    $movies = Model("MovieModel")->getAllUmovies();
//    return $this->view('admin/movie/index',['movies' => $movies], true);
    // Instancie le modèle pour gérer les cinémas.
    $mm = model("MovieModel");

    // Vérifie si un ID est passé en paramètre
    if ($id == null) {
        // Si aucun ID n'est fourni, récupère tous les cinémas
        $movies = $mm->findAll();

        // Renvoie la vue listant les cinémas en passant les données récupérées
        return $this->view("/admin/movie/index.php", ['cinemas' => $movies], true);
    } else {
        // Si l'ID est égal à "new", cela signifie qu'un nouveau cinéma doit être créé
        if ($id == "new") {
            // Ajoute un breadcrumb pour indiquer la création d'un nouveau cinéma
            return $this->view("admin/movie/movie", [],true);

        }
        // Sinon, on suppose que l'ID correspond à un cinéma existant, récupère ses informations
        $movies = $mm->find($id);

        // Vérifie si le cinéma existe
        if ($movies) {
            // Ajoute un breadcrumb pour indiquer la modification du cinéma
            $this->addBreadcrumb('Modification de ' . $movies['name'], '');
            return $this->view("/admin/movie/movie", ["movie" => $movies], true);

        } else {
            // Si le cinéma avec cet ID n'existe pas, affiche un message d'erreur
            $this->error("L'ID du film n'existe pas");

            // Redirige l'utilisateur vers la liste des cinémas
            $this->redirect("/admin/movie");
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