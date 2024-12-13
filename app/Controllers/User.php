<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MediaModel;

class User extends BaseController
{
    protected $require_auth = false;

    public function getindex($id)
    {
        $um = new UserModel();
        $user = $um->getUserById($id);

        return $this->view('user/user', ['user' => $user]);
    }

    public function postupdate()
    {
        // Récupération des données envoyées via POST
        $data = [
            'id' => $this->request->getPost('id'),
            'username' => $this->request->getPost('username'),
            'firstname' => $this->request->getPost('firstname'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        $um = new UserModel();

        // Gestion de l'image
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $mm = new MediaModel();
            $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'user');

            // Suppression de l'ancien média
            if ($old_media && file_exists($old_media[0]['path'])) {
                unlink($old_media[0]['path']);
                $mm->deleteMedia($old_media[0]['id']);
            }

            // Enregistrement du nouveau fichier
            $path = WRITEPATH . 'uploads/';
            $newName = $file->getRandomName();
            $file->move($path, $newName);

            $mediaData = [
                'entity_type' => 'user',
                'entity_id' => $data['id'],

            ];

            $mm->save($mediaData);
        }

        // Mise à jour des informations utilisateur
        if ($um->updateUser($data['id'], $data)) {
            $this->success("L'utilisateur a bien été modifié.");
        } else {
            if ($errors = $um->errors()) {
                foreach ($errors as $error) {
                    $this->error($error);
                }
            }
        }

        return $this->redirect('user/user');
    }
}
