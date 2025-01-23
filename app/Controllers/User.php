<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MediaModel;

class User extends BaseController
{
    protected $require_auth = false;

    /**
     * Affiche les informations d'un utilisateur.
     *
     * Cette méthode récupère les informations de l'utilisateur par son ID
     * et les transmet à la vue 'user/user' pour affichage.
     *
     * @param int $id L'identifiant de l'utilisateur à afficher.
     * @return string La vue affichant les informations de l'utilisateur.
     */
    public function getindex($id)
    {
        // Créer une instance du modèle UserModel
        $um = new UserModel();
        // Récupérer l'utilisateur par son ID
        $user = $um->getUserById($id);

        // Retourner la vue avec les données de l'utilisateur
        return $this->view('user/user', ['user' => $user]);
    }

    /**
     * Met à jour les informations d'un utilisateur.
     *
     * Cette méthode traite le formulaire de mise à jour des informations d'un utilisateur,
     * y compris la gestion de l'image de profil si un fichier est soumis.
     *
     * @return \CodeIgniter\HTTP\Response La réponse après la mise à jour des données.
     */
    public function postupdate()
    {
        // Récupération des données envoyées dans le formulaire
        $data = $this->request->getPost();

        // Créer une instance du modèle UserModel
        $um = Model("UserModel");

        // Vérifier si un fichier a été soumis dans le formulaire
        $file = $this->request->getFile('profile_image'); // 'profile_image' est le nom du champ dans le formulaire
        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            // Créer une instance du modèle MediaModel pour gérer les médias
            $mm = Model('MediaModel');
            // Récupérer l'ancien média (image de profil) de l'utilisateur
            $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'user');

            // Préparer les données pour l'upload du nouveau fichier
            $mediaData = [
                'entity_type' => 'user',   // Type d'entité (utilisateur)
                'entity_id'   => $data['id'],   // ID de l'utilisateur
            ];

            // Utiliser la fonction 'upload_file' pour gérer l'upload de l'image de profil
            $uploadResult = upload_file($file, 'avatar', $data['username'], $mediaData, true, ['image/jpeg', 'image/png','image/jpg']);

            // Vérifier le résultat de l'upload
            if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                // Afficher un message d'erreur et rediriger si l'upload échoue
                $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                return $this->redirect("film/");
            }

            // Si l'upload est un succès, supprimer l'ancien média
            if ($old_media) {
                $mm->deleteMedia($old_media[0]['id']);
            }
        }

        // Mettre à jour les informations de l'utilisateur dans la base de données
        if ($um->updateUser($data['id'], $data)) {
            // Afficher un message de succès si la mise à jour est réussie
            $this->success("L'utilisateur a bien été modifié.");
        } else {
            // Gérer les erreurs de mise à jour en affichant les messages d'erreur
            $errors = $um->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
        }

        // Rediriger vers la page des films après la mise à jour
        return $this->redirect('film/');
    }
}
