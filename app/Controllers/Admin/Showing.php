<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

// Contrôleur pour gérer les opérations liées aux séances dans la partie admin
class Showing extends BaseController
{
    // Méthode principale pour afficher ou gérer une séance spécifique
    public function getindex($id = null)
    {
        $sm = model('ShowingModel'); // Chargement du modèle ShowingModel

        // Si aucun ID n'est passé
        if ($id == null) {
            // Récupère toutes les séances
            $showing = $sm->findAll();
            // Affiche la vue listant toutes les séances
            return $this->view('admin/showing/index', ['showing' => $showing], true);
        } else {
            // Récupère toutes les séances et tous les films
            $showing = model('ShowingModel')->getAllShowing();
            $movies = model('MovieModel')->getAllMovies();
            $cinema = model('CinemaModel')->getAlltheater();

            // Si l'ID est "new", cela signifie qu'une nouvelle séance doit être créée
            if ($id == "new") {
                return $this->view('admin/showing/showing', ['showing' => $showing, 'movies' => $movies, 'cinema' => $cinema], true);
            }

            // Sinon, on récupère la séance correspondant à l'ID
            $showing = $sm->getShowingById($id);

            if ($showing) {
                // Si la séance existe, on charge la vue correspondante
                return $this->view("/admin/showing/showing", ['showing' => $showing], true);
            } else {
                // Si l'ID de la séance est invalide, affiche un message d'erreur
                $this->error("L'ID de la séance n'existe pas");

                // Redirige vers la liste des séances
                $this->redirect("/admin/showing");
            }
        }
    }

    // Méthode pour créer une nouvelle séance
    public function postcreate()
    {
        $data = $this->request->getPost(); // Récupère les données POST envoyées par le formulaire
        $sm = Model("ShowingModel"); // Chargement du modèle ShowingModel

        // Crée une nouvelle séance et récupère son ID
        $newShowingId = $sm->createShowing($data);

        if ($newShowingId) {
            // Si la création a réussi, affiche un message de succès
            $this->success("La séance a bien été ajoutée.");
            $this->redirect("/admin/showing"); // Redirige vers la liste des séances
        } else {
            // En cas d'échec, récupère les erreurs
            $errors = $sm->errors();
            foreach ($errors as $error) {
                $this->error($error);
                $this->redirect("/admin/showing/new"); // Redirige vers la page de création
            }
        }
    }

    // Méthode pour rechercher des séances avec pagination (utilisée avec DataTables)
    public function postSearchShowing()
    {
        $showingModel = model('App\Models\ShowingModel'); // Chargement du modèle ShowingModel

        // Récupère les paramètres envoyés par DataTables
        $draw = $this->request->getPost('draw');
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';

        // Récupère les données triées et filtrées
        $data = $showingModel->getPaginatedShowing($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Récupère le total des séances (non filtrées et filtrées)
        $totalRecords = $showingModel->getTotalShowing();
        $filteredRecords = $showingModel->getFilteredShowing($searchValue);

        // Prépare le résultat pour DataTables
        $result = [
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ];

        // Retourne le résultat au format JSON
        return $this->response->setJSON($result);
    }

    // Méthode pour désactiver une séance
    public function getdeactivate($id)
    {
        $sm = Model('ShowingModel'); // Chargement du modèle ShowingModel

        if ($sm->deleteShowing($id)) {
            // Si la désactivation réussit, affiche un message de succès
            $this->success("Séance désactivée");
        } else {
            // Sinon, affiche un message d'erreur
            $this->error("Séance non désactivée");
        }

        // Redirige vers la liste des séances
        $this->redirect('/admin/showing');
    }

    // Méthode pour activer une séance
    public function getactivate($id)
    {
        $sm = Model('ShowingModel'); // Chargement du modèle ShowingModel

        if ($sm->activateShowing($id)) {
            // Si l'activation réussit, affiche un message de succès
            $this->success("Séance activée");
        } else {
            // Sinon, affiche un message d'erreur
            $this->error("Séance non activée");
        }

        // Redirige vers la liste des séances
        $this->redirect('/admin/showing');
    }
}
