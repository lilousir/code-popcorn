<?php
namespace App\Controllers;

use App\Models\UserModel;  // Importation du modèle UserModel pour interagir avec la base de données
use CodeIgniter\RESTful\ResourceController;  // Importation de la classe ResourceController pour les contrôleurs RESTful

class Auth extends ResourceController
{
protected $format = 'json';  // Définition du format de réponse en JSON

/**
* Méthode pour générer un token JWT après vérification des identifiants de l'utilisateur.
*
* @return \CodeIgniter\HTTP\Response JSON contenant le token
*/
public function postgeneratetoken()
{
// Récupération de l'email et du mot de passe envoyés dans la requête POST
$email = $this->request->getPost('mail');  // L'adresse email de l'utilisateur
$password = $this->request->getPost('password');  // Le mot de passe de l'utilisateur

// Chargement du modèle UserModel pour vérifier les identifiants
$um = Model('UserModel');

// Vérification des identifiants (email et mot de passe)
$user = $um->verifyLogin($email, $password);

// Si les identifiants sont incorrects, on retourne une erreur 401 Unauthorized
if (!$user) {
return $this->failUnauthorized('Invalid credentials');  // Code 401 : Crédentiels invalides
}

// Si les identifiants sont corrects, on génère un token JWT pour l'utilisateur
$token = generateToken($user['id']);  // Appel à la fonction generateToken pour générer un JWT

// Retourne le token JWT dans la réponse JSON
return $this->respond(['token' => $token]);  // Réponse avec le token généré
}

/**
* Méthode pour récupérer des données protégées, accessible uniquement avec un token valide.
*
* @return \CodeIgniter\HTTP\Response Données protégées ou erreur 401 si le token est invalide
*/
public function getprotecteddata()
{
// Récupération du token envoyé dans l'en-tête "Authorization" de la requête
$token = $this->request->getHeaderLine('Authorization');  // L'en-tête contenant le token JWT

// Si un token est présent et correspond au format "Bearer <token>", on le valide
    if ($token && preg_match('/Bearer\s(\S+)/', $token, $matches)) {
    // Validation du token et récupération de l'ID de l'utilisateur
    $userId = validateToken($matches[1]);  // Appel à la fonction validateToken pour vérifier le token

    // Si le token est valide, on accorde l'accès aux données protégées
    if ($userId) {
    // Retourne un message indiquant que l'accès est autorisé et des données protégées
    return $this->respond(['message' => 'Access granted', 'data' => 'This is protected data']);
    }
    }

    // Si le token est absent, invalide ou expiré, on retourne une erreur 401 Unauthorized
    return $this->failUnauthorized('Invalid or expired token');  // Code 401 : Token invalide ou expiré
    }
    }
