<?php

namespace App\Controllers;

use App\Entities\User;

class Login extends BaseController
{
    protected $require_auth = false; // Indique que l'authentification n'est pas requise pour ce contrôleur

    /**
     * Affiche la page de connexion.
     *
     * @return string La vue de la page de connexion.
     */
    public function getindex(): string
    {
        return view('/login/login');
    }

    /**
     * Traite la connexion de l'utilisateur.
     *
     * @return \CodeIgniter\HTTP\Response La réponse après le traitement de la connexion.
     */
    public function postindex()
    {
        // Récupère les informations de connexion envoyées par l'utilisateur
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Vérifie les informations d'identification via le modèle UserModel
        $um = Model('UserModel');
        $user = $um->verifyLogin($email, $password);

        if ($user) {
            // Si l'utilisateur est trouvé, crée une instance de l'entité User
            $user = new User($user);
            if (!$user->isActive()) {
                // Si l'utilisateur n'est pas actif, renvoie la page de connexion
                return view('/login/login');
            }
            // Si l'utilisateur est actif, on le connecte et redirige vers la page d'accueil
            $this->session->set('user', $user);
            return $this->redirect('/');
        } else {
            // En cas d'échec de la connexion, renvoie à la page de connexion
            return view('/login/login');
        }
    }

    /**
     * Affiche la page d'inscription.
     *
     * @return string La vue de la page d'inscription.
     */
    public function getregister()
    {
        $flashData = session()->getFlashdata('data');  // Récupère les données flash, comme les erreurs de validation

        // Prépare les données à passer à la vue d'inscription
        $data = [
            'errors' => $flashData['errors'] ?? null,  // Les erreurs de validation sont passées à la vue si elles existent
            // D'autres données peuvent être ajoutées ici si nécessaire
        ];

        return view('/login/register', $data); // Affiche la vue d'inscription
    }

    /**
     * Traite l'inscription de l'utilisateur.
     *
     * @return \CodeIgniter\HTTP\Response La réponse après le traitement de l'inscription.
     */
    public function postregister()
    {
        // Récupère les informations d'inscription envoyées par l'utilisateur
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $username = $this->request->getPost('username');

        // Données à enregistrer dans la base de données
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'id_permission' => 3,  // Permission par défaut (utilisateur normal)
        ];

        $um = Model('UserModel');

        // Crée un nouvel utilisateur
        if (!$um->createUser($data)) {
            // Si l'enregistrement échoue, récupère les erreurs de validation
            $errors = $um->errors();
            $data = ['errors' => $errors];
            return $this->redirect("/login/register", $data);  // Redirige vers la page d'inscription avec les erreurs
        }

        // Si l'inscription réussit, redirige vers la page de connexion
        return $this->redirect("/login");
    }

    /**
     * Déconnecte l'utilisateur et le redirige vers la page de connexion.
     *
     * @return \CodeIgniter\HTTP\Response La réponse après la déconnexion.
     */
    public function getlogout()
    {
        $this->logout();  // Méthode pour déconnecter l'utilisateur
        return $this->redirect("/login");  // Redirige vers la page de connexion
    }
}
