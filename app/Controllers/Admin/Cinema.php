<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Cinema extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];
    public function getIndex($id = null) {

        // Instancie le modèle pour gérer les cinémas.
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
                $city = Model("CityModel")->getAllCity();
                // Ajoute un breadcrumb pour indiquer la création d'un nouveau cinéma
                return $this->view("admin/cinema/cinema", ['city' => $city],true);

            }
            // Sinon, on suppose que l'ID correspond à un cinéma existant, récupère ses informations
            $cinema = $cm->getTheatersById($id);

            // Vérifie si le cinéma existe
            if ($cinema) {
                // Ajoute un breadcrumb pour indiquer la modification du cinéma
                $this->addBreadcrumb('Modification de ' . $cinema['name'], '');
                return $this->view("/admin/cinema/cinema", ["cinema" => $cinema], true);

            } else {
                // Si le cinéma avec cet ID n'existe pas, affiche un message d'erreur
                $this->error("L'ID du cinéma n'existe pas");

                // Redirige l'utilisateur vers la liste des cinémas
                $this->redirect("/admin/cinema");
            }
        }
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $cm = Model("CinemaModel");

        // Créer cinema et obtenir son ID
        $newCinemaId = $cm->createCinema($data);


        // Vérifier si la création a réussi
        if ($newCinemaId) {
            if ($newCinemaId) {
                // Vérifier si des fichiers ont été soumis dans le formulaire
                $file = $this->request->getFile('photo_image'); // 'profile_image' est le nom du champ dans le formulaire
                if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                    // Préparer les données du média
                    $mediaData = [
                        'entity_type' => 'theater',
                        'entity_id' => $newCinemaId,   // Utiliser le nouvel ID de l'utilisateur
                    ];

                    // Utiliser la fonction upload_file() pour gérer l'upload et les données du média
                    $uploadResult = upload_file($file, 'theater', $data['name'], $mediaData);

                    // Vérifier le résultat de l'upload
                    if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                        // Afficher un message d'erreur détaillé et rediriger
                        $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                        return $this->redirect("/admin/cinema/new");
                    }
                }
                $this->success("Se cinema à bien été ajouté.");
                $this->redirect("/admin/cinema");
            } else {
                $errors = $cm->errors();
                foreach ($errors as $error) {
                    $this->error($error);
                    $this->redirect("/admin/cinema/new");
                }

            }

        }

    }
    public function postupdate()
    {
        // Récupération des données envoyées via POST
        $data = $this->request->getPost();

        // Récupération du modèle UserModel
        $cm = Model("CinemaModel");

        // Mise à jour des informations utilisateur dans la base de données
        if ($cm->updateCinema($data['id'], $data)) {
            $file = $this->request->getFile('photo_image'); // 'profile_image' est le nom du champ dans le formulaire
            // Si un fichier a été soumis
            if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                // Récupération du modèle MediaModel
                $mm = Model('MediaModel');
                // Récupérer l'ancien média avant l'upload
                $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'theater');

                // Préparer les données du média pour le nouvel upload
                $mediaData = [
                    'entity_type' => 'theater',
                    'entity_id'   => $data['id'],   // Utiliser l'ID de l'utilisateur
                ];

                // Utiliser la fonction upload_file() pour gérer l'upload et enregistrer les données du média
                $uploadResult = upload_file($file, 'photo', $data['name'], $mediaData, true, ['image/jpeg', 'image/png','image/jpg']);

                // Vérifier le résultat de l'upload
                if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    // Afficher un message d'erreur détaillé et rediriger
                    $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                    return $this->redirect("/admin/cinema");
                }

                // Si l'upload est un succès, suppression de l'ancien média
                if ($old_media) {
                    $mm->deleteMedia($old_media[0]['id']);
                }
            }

            // Si la mise à jour réussit
            $this->success("Le cinéma a bien été modifié.");
        } else {
            $errors = $cm->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
        }

        // Redirection vers la page des films après le traitement
        return $this->redirect("/admin/cinema");
    }

    public function postSearchCinema()
    {
        $CinemaModel = model('App\Models\CinemaModel');

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
        $data = $CinemaModel->getPaginatedCinema($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $CinemaModel->getTotalCinema();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $CinemaModel->getFilteredCinema($searchValue);


        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
    public function getautocompletecity(){
        $searchValue = $this->request->getGet('q'); // Récupère le terme de recherche envoyé par Select2

        $cityModel = Model("CityModel");

        // Appelle la méthode de recherche dans le modèle
        $city = $cityModel->searchCityByName($searchValue);

        // Formatage des résultats pour Select2
        $results = [];
        foreach ($city as $c) {
            $results[] = [
                'id' => $c['id'],  // Utilise le slug comme ID pour redirection ultérieure
                'text' => $c['label']." - " .$c['zip_code']// Ce texte sera affiché dans le dropdown de Select2
            ];
        }

        // Retourne les résultats sous forme JSON pour Select2
        return $this->response->setJSON($results);
    }
}