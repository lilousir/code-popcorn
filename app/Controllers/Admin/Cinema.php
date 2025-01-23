<?php

namespace App\Controllers\Admin;

// Importe la classe de base pour les contrôleurs
use App\Controllers\BaseController;

class Cinema extends BaseController
{
    // Indique que l'authentification est requise pour accéder à ce contrôleur
    protected $require_auth = true;

    // Définit les permissions nécessaires pour accéder à ces fonctionnalités
    protected $requiredPermissions = ['administrateur'];

    // Méthode pour gérer la page d'accueil ou afficher les détails d'un cinéma
    public function getIndex($id = null) {

        // Instancie le modèle pour gérer les cinémas
        $cm = model("CinemaModel");

        // Vérifie si un ID est passé en paramètre
        if ($id == null) {
            // Si aucun ID n'est fourni, récupère tous les cinémas
            $cinemas = $cm->findAll();

            // Renvoie la vue listant les cinémas en passant les données récupérées
            return $this->view("/admin/cinema/index.php", ['cinemas' => $cinemas], true);
        } else {
            // Si l'ID est égal à "new", cela signifie qu'un nouveau cinéma doit être créé
            if ($id == "new") {
                $city = Model("CityModel")->getAllCity(); // Récupère toutes les villes disponibles
                // Renvoie la vue pour créer un nouveau cinéma avec la liste des villes
                return $this->view("admin/cinema/cinema", ['city' => $city], true);
            }

            // Sinon, récupère les informations d'un cinéma existant par son ID
            $cinema = $cm->getTheatersById($id);

            // Vérifie si le cinéma existe
            if ($cinema) {
                // Ajoute un fil d'Ariane pour la modification
                $this->addBreadcrumb('Modification de ' . $cinema['name'], '');
                return $this->view("/admin/cinema/cinema", ["cinema" => $cinema], true);
            } else {
                // Si le cinéma n'existe pas, affiche une erreur et redirige
                $this->error("L'ID du cinéma n'existe pas");
                $this->redirect("/admin/cinema");
            }
        }
    }

    // Méthode pour créer un nouveau cinéma
    public function postcreate() {
        $data = $this->request->getPost(); // Récupère les données POST
        $cm = Model("CinemaModel"); // Instancie le modèle CinemaModel

        // Crée le cinéma et retourne son ID
        $newCinemaId = $cm->createCinema($data);

        // Vérifie si la création a réussi
        if ($newCinemaId) {
            // Vérifie si un fichier image a été soumis
            $file = $this->request->getFile('photo_url');



            // Si un fichier valide est soumis, procède à l'upload
            if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $mediaData = [
                    'entity_type' => 'theater',
                    'entity_id' => $newCinemaId,
                ];

                // Gère l'upload et associe le média au cinéma
                $uploadResult = upload_file($file, 'theater', $data['name'], $mediaData);

                // Si une erreur survient lors de l'upload
                if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                    return $this->redirect("/admin/cinema/new");
                }
            }

            // Confirme la création et redirige
            $this->success("Le cinéma a bien été ajouté.");
            $this->redirect("/admin/cinema");
        } else {
            // Si des erreurs sont retournées, les affiche
            $errors = $cm->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }

            // Redirige vers la page de création
            return $this->redirect("/admin/cinema/new");
        }
    }

    // Méthode pour mettre à jour un cinéma existant
    public function postupdate() {
        // Récupère les données POST
        $data = $this->request->getPost();

        // Instancie le modèle CinemaModel
        $cm = Model("CinemaModel");

        // Met à jour les informations du cinéma
        if ($cm->updateCinema($data['id'], $data)) {
            $file = $this->request->getFile('photo_image'); // Récupère le fichier soumis

            // Si un fichier est soumis
            if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $mm = Model('MediaModel'); // Instancie le modèle MediaModel

                // Récupère l'ancien média avant l'upload
                $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'theater');

                // Prépare les données pour le nouvel upload
                $mediaData = [
                    'entity_type' => 'theater',
                    'entity_id' => $data['id'],
                ];

                // Gère l'upload et remplace le média existant
                $uploadResult = upload_file($file, 'photo', $data['name'], $mediaData, true, ['image/jpeg', 'image/png', 'image/jpg']);

                // Si une erreur survient lors de l'upload
                if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                    return $this->redirect("/admin/cinema");
                }

                // Si l'upload est réussi, supprime l'ancien média
                if ($old_media) {
                    $mm->deleteMedia($old_media[0]['id']);
                }
            }

            // Confirme la mise à jour
            $this->success("Le cinéma a bien été modifié.");
        } else {
            // Si des erreurs surviennent
            $errors = $cm->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
        }

        // Redirige vers la liste des cinémas
        return $this->redirect("/admin/cinema");
    }

    // Méthode pour rechercher des cinémas avec pagination et tri
    public function postSearchCinema() {
        $CinemaModel = model('App\Models\CinemaModel');

        // Récupère les paramètres de pagination et de recherche
        $draw = $this->request->getPost('draw');
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Récupère les informations de tri
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';

        // Récupère les données filtrées et triées
        $data = $CinemaModel->getPaginatedCinema($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Récupère les totaux pour les enregistrements filtrés et non filtrés
        $totalRecords = $CinemaModel->getTotalCinema();
        $filteredRecords = $CinemaModel->getFilteredCinema($searchValue);

        // Retourne les résultats au format JSON
        $result = [
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ];
        return $this->response->setJSON($result);
    }

    // Méthode pour l'autocomplétion des villes
    public function getautocompletecity() {
        $searchValue = $this->request->getGet('q'); // Récupère le terme de recherche

        $cityModel = Model("CityModel");

        // Recherche les villes correspondant au terme
        $city = $cityModel->searchCityByName($searchValue);

        // Formate les résultats pour l'autocomplétion
        $results = [];
        foreach ($city as $c) {
            $results[] = [
                'id' => $c['id'], // ID de la ville
                'text' => $c['label'] . " - " . $c['zip_code'], // Nom et code postal
            ];
        }

        // Retourne les résultats au format JSON
        return $this->response->setJSON($results);
    }
}
