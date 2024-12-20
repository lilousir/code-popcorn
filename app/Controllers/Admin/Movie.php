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
        $cm = model("CategoryModel");
        $cmm = model("CategoryMovieModel");

        // Récupère toutes les catégories
        $categorys = $cm->getAllCategory();

        // Si aucun ID n'est fourni, affiche la liste de tous les films
        if ($id === null) {
            $movies = $mm->findAll();
            return $this->view("/admin/movie/index.php", [
                'movies' => $movies,
                'category' => $categorys
            ], true);
        }

        // Si l'ID est "new", prépare la vue pour créer un nouveau film
        if ($id === "new") {
            return $this->view("/admin/movie/movie", [
                'category' => $categorys
            ], true);
        }

        // Si l'ID est numérique, récupère les informations du film correspondant
        $movies = $mm->getMovieById($id);

        if ($movies) {
            // Récupère les catégories associées au film
            $categoriesForMovie = $cmm->getAllFullMovieCategorieByIdMovie($id);

            // Ajoute un breadcrumb pour indiquer la modification du film
            $this->addBreadcrumb('Modification de ' . htmlspecialchars($movies['title']), '');

            // Affiche la vue de modification avec les données du film et ses catégories
            return $this->view("/admin/movie/movie", [
                "movie" => $movies,
                "category" => $categorys,
                "categoriesForMovie" => $categoriesForMovie
            ], true);
        } else {
            // Si le film n'existe pas, affiche un message d'erreur et redirige
            $this->error("L'ID du film n'existe pas");
            return $this->redirect("/admin/movie");
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
            if ($newMovieId) {
                // Vérifier si des fichiers ont été soumis dans le formulaire
                $file = $this->request->getFile('affiche_image'); // 'profile_image' est le nom du champ dans le formulaire
                if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                    // Préparer les données du média
                    $mediaData = [
                        'entity_type' => 'movie',
                        'entity_id' => $newMovieId,   // Utiliser le nouvel ID de l'utilisateur
                    ];

                    // Utiliser la fonction upload_file() pour gérer l'upload et les données du média
                    $uploadResult = upload_file($file, 'movie', $data['title'], $mediaData);

                    // Vérifier le résultat de l'upload
                    if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                        // Afficher un message d'erreur détaillé et rediriger
                        $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                        return $this->redirect("/admin/movie/new");
                    }
                }
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

    }



    public function postupdate() {
        // Récupération des données envoyées via POST
        $data = $this->request->getPost();

        // Récupération du modèle UserModel
        $um = Model("MovieModel");

        // Vérifier si un fichier a été soumis dans le formulaire


        // Mise à jour des informations utilisateur dans la base de données
        if ($um->updateMovie($data['id'], $data)) {
            $file = $this->request->getFile('affiche_image'); // 'profile_image' est le nom du champ dans le formulaire
            // Si un fichier a été soumis
            if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                // Récupération du modèle MediaModel
                $mm = Model('MediaModel');
                // Récupérer l'ancien média avant l'upload
                $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'movie');

                // Préparer les données du média pour le nouvel upload
                $mediaData = [
                    'entity_type' => 'movie',
                    'entity_id'   => $data['id'],   // Utiliser l'ID de l'utilisateur
                ];

                // Utiliser la fonction upload_file() pour gérer l'upload et enregistrer les données du média
                $uploadResult = upload_file($file, 'affiche', $data['title'], $mediaData, true, ['image/jpeg', 'image/png','image/jpg']);

                // Vérifier le résultat de l'upload
                if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    // Afficher un message d'erreur détaillé et rediriger
                    $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                    return $this->redirect("/admin/movie");
                }

                // Si l'upload est un succès, suppression de l'ancien média
                if ($old_media) {
                    $mm->deleteMedia($old_media[0]['id']);
                }
            }
            // Si la mise à jour réussit
            $this->success("Le film a bien été modifié.");
        } else {
            $errors = $um->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
        }


        // Redirection vers la page des utilisateurs après le traitement
        return $this->redirect("/admin/movie");


    }
    public function getdeactivate($id){
        $mm = Model('MovieModel');
        if ($mm->deleteMovie($id)) {
            $this->success("film  désactivé");
        } else {
            $this->error("film  non désactivé");
        }
        $this->redirect('/admin/movie');
    }

    public function getactivate($id){
        $mm = Model('MovieModel');
        if ($mm->activateMovie($id)) {
            $this->success("film activé");
        } else {
            $this->error("film non activé");
        }
        $this->redirect('/admin/movie');
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

    public function getcategory()
    {
        $c = model("CategoryModel");
        $category = $c->getAllCategory();
        return $this->view('admin/category/category', ['category' => $category], true);
    }
    public function postcreatecategory() {
        $data = $this->request->getPost();
        $gm = Model('CategoryModel');
        if ($gm->createCategory($data)) {
            $this->success('Category ajouté');
        } else {
            $this->error('Category non ajouté');
        }
        $this->redirect('/admin/movie/category');
    }
    public function gettotalmoviebycategory() {
        $id = $this->request->getGet("id");
        $igim = model('CategoryMovieModelModel');
        return json_encode($igim->getTotalMovieByCategoryId($id));
    }

    public function postupdatecategory() {
        $data = $this->request->getPost();

        $ibm = Model('CategoryModel');
        $ibm->updateCategory($data['id'], $data);
        return json_encode($ibm->getCategoryById($data['id']));
    }
    public function getdeletecategory($id) {
        $cm = model("CategoryModel");
        if ($cm->deleteCategory($id)) {
            $this->success("Category supprimé");
        } else {
            $this->error("Category non supprimé");
        }
        return $this->redirect('/admin/movie/category');
    }

    public function postsearchcategory()
    {
        $categoryModel = model('App\Models\CategoryModel');

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
        $data = $categoryModel-> getPaginatedCategory($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $categoryModel-> getTotalCategory();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $categoryModel-> getFilteredCategory($searchValue);


        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }

}