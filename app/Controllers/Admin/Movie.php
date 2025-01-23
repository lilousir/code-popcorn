<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

// Contrôleur pour gérer les opérations liées aux films dans la partie admin
class Movie extends BaseController
{
    // Propriétés pour vérifier les permissions d'accès
    protected $require_auth = true; // Nécessite une authentification
    protected $requiredPermissions = ['administrateur']; // Seuls les administrateurs peuvent accéder

    // Méthode principale pour afficher les films ou gérer un film spécifique
    public function getindex($id = null)
    {
        // Chargement des modèles nécessaires
        $mm = model("MovieModel"); // Modèle pour gérer les films
        $cm = model("CategoryModel"); // Modèle pour gérer les catégories
        $cmm = model("CategoryMovieModel"); // Modèle pour lier films et catégories

        // Récupère toutes les catégories existantes dans la base de données
        $categorys = $cm->getAllCategory();

        // Si aucun ID n'est fourni, affiche tous les films
        if ($id === null) {
            $movies = $mm->findAll(); // Récupère tous les films
            return $this->view("/admin/movie/index.php", [
                'movies' => $movies, // Liste des films à afficher
                'category' => $categorys // Liste des catégories disponibles
            ], true);
        }

        // Si l'ID est "new", cela signifie qu'on veut créer un nouveau film
        if ($id === "new") {
            return $this->view("/admin/movie/movie", [
                'category' => $categorys // Passe les catégories à la vue pour les afficher dans un formulaire
            ], true);
        }

        // Si un ID numérique est fourni, on charge le film correspondant
        $movies = $mm->getMovieById($id); // Récupère le film par son ID

        if ($movies) {
            // Si le film existe, récupère les catégories associées
            $categoriesForMovie = $cmm->getAllFullMovieCategorieByIdMovie($id);

            // Ajoute un fil d'Ariane pour la modification du film
            $this->addBreadcrumb('Modification de ' . htmlspecialchars($movies['title']), '');

            // Charge la vue de modification avec les données du film et ses catégories
            return $this->view("/admin/movie/movie", [
                "movie" => $movies, // Données du film
                "category" => $categorys, // Toutes les catégories
                "categoriesForMovie" => $categoriesForMovie // Catégories associées au film
            ], true);
        } else {
            // Si l'ID du film est invalide ou inexistant
            $this->error("L'ID du film n'existe pas"); // Affiche un message d'erreur
            return $this->redirect("/admin/movie"); // Redirige vers la liste des films
        }
    }

    // Méthode pour créer un nouveau film
    public function postcreate()
    {
        $data = $this->request->getPost(); // Récupère les données du formulaire
        $cm = Model("MovieModel"); // Modèle des films

        // Crée un nouveau film dans la base de données
        $newMovieId = $cm->createMovie($data);

        if ($newMovieId) {
            // Si le film est créé avec succès, vérifie si une affiche est uploadée
            $file = $this->request->getFile('affiche_image');
            if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                // Prépare les métadonnées pour l'affiche
                $mediaData = [
                    'entity_type' => 'movie', // Type de l'entité
                    'entity_id' => $newMovieId, // ID du film
                ];

                // Fonction pour gérer l'upload de l'affiche
                $uploadResult = upload_file($file, 'movie', $data['title'], $mediaData);

                if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    // En cas d'erreur pendant l'upload
                    $this->error("Erreur lors de l'upload : " . $uploadResult['message']);
                    return $this->redirect("/admin/movie/new"); // Redirige vers la création
                }
            }

            // Si tout s'est bien passé
            $this->success("Le film a bien été ajouté.");
            $this->redirect("/admin/movie"); // Redirige vers la liste des films
        } else {
            // Gestion des erreurs lors de la création du film
            $errors = $cm->errors();
            foreach ($errors as $error) {
                $this->error($error); // Affiche chaque erreur
            }
            $this->redirect("/admin/movie/new"); // Redirige vers la création
        }
    }

    // Méthode pour mettre à jour un film existant
    public function postupdate()
    {
        $data = $this->request->getPost(); // Récupère les données du formulaire
        $um = Model("MovieModel"); // Modèle des films

        // Met à jour le film dans la base de données
        if ($um->updateMovie($data['id'], $data)) {
            // Gère l'upload d'une nouvelle affiche si nécessaire
            $file = $this->request->getFile('affiche_image');
            if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $mm = Model('MediaModel'); // Modèle des médias
                $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'movie'); // Ancienne affiche

                // Prépare les métadonnées pour la nouvelle affiche
                $mediaData = [
                    'entity_type' => 'movie',
                    'entity_id' => $data['id'],
                ];

                // Gère l'upload de la nouvelle affiche
                $uploadResult = upload_file($file, 'affiche', $data['title'], $mediaData, false, ['image/jpeg', 'image/png', 'image/jpg']);

                if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    // En cas d'erreur pendant l'upload
                    $this->error("Erreur lors de l'upload : " . $uploadResult['message']);
                    return $this->redirect("/admin/movie");
                }

                // Supprime l'ancienne affiche si une nouvelle est uploadée
                if ($old_media) {
                    $mm->deleteMedia($old_media[0]['id']);
                }
            }
            $this->success("Le film a bien été modifié.");
        } else {
            // Gestion des erreurs
            $errors = $um->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
        }

        return $this->redirect("/admin/movie"); // Redirige vers la liste des films
    }

    // Méthodes pour activer ou désactiver un film
    public function getdeactivate($id)
    {
        $mm = Model('MovieModel');
        if ($mm->deleteMovie($id)) {
            $this->success("Film désactivé");
        } else {
            $this->error("Film non désactivé");
        }
        $this->redirect('/admin/movie');
    }

    public function getactivate($id)
    {
        $mm = Model('MovieModel');
        if ($mm->activateMovie($id)) {
            $this->success("Film activé");
        } else {
            $this->error("Film non activé");
        }
        $this->redirect('/admin/movie');
    }

    // Recherche de films avec pagination
    public function postSearchMovies()
    {
        $MovieModel = model('App\Models\MovieModel'); // Modèle des films
        $draw = $this->request->getPost('draw'); // Nombre de requêtes DataTables
        $start = $this->request->getPost('start'); // Début de la pagination
        $length = $this->request->getPost('length'); // Nombre de résultats par page
        $searchValue = $this->request->getPost('search')['value']; // Terme recherché
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0; // Index de la colonne triée
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc'; // Direction du tri
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id'; // Nom de la colonne triée

        // Récupère les films paginés selon les critères
        $data = $MovieModel->getPaginatedMovie($start, $length, $searchValue, $orderColumnName, $orderDirection);
        $totalRecords = $MovieModel->getTotalMovie(); // Total des films
        $filteredRecords = $MovieModel->getFilteredMovie($searchValue); // Total après filtre

        // Structure la réponse pour DataTables
        $result = [
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ];
        return $this->response->setJSON($result); // Retourne la réponse en JSON
    }
}
