<?php


namespace App\Controllers;

use App\Controllers\BaseController;  // Importation de la classe de base pour les contrôleurs

    class Cinema extends BaseController{

    protected $require_auth = false;  // Cette propriété indique que l'authentification n'est pas requise pour accéder à ce contrôleur.

    /**
    * Méthode pour afficher la liste des cinémas ou les détails d'un cinéma spécifique.
    *
    * @param int|null $id L'ID du cinéma à afficher (si fourni)
    * @return \CodeIgniter\HTTP\Response Vue contenant la liste des cinémas ou les détails d'un cinéma spécifique
    */
        public function getindex($id = null){

    // Charger le modèle des cinémas pour interagir avec la base de données
    $cm = model("CinemaModel");

    // Si aucun ID n'est fourni, afficher la liste des cinémas
    if ($id === null) {
    // Récupérer les paramètres GET envoyés par la requête
    $data = $this->request->getGet();

    // Définir le nombre de cinémas à afficher par page
    $perPage = 8;

    // Récupérer les cinémas filtrés (en fonction des données de la requête) avec la pagination
    $cinemas = $cm->getAllMovieFiltered($data, 8, $perPage);

    // Récupérer l'objet pager pour la pagination
    $pager = $cm->pager;

    // Retourner la vue avec la liste des cinémas et les informations de pagination
    return $this->view('cinema/cinemas', ['cinemas' => $cinemas, 'pager' => $pager]);
}

    // Si un ID de cinéma est fourni, afficher les détails du cinéma correspondant
    $cinema = $cm->getTheatersById($id);

    // Si un cinéma correspondant à l'ID est trouvé, retourner la vue avec les détails du cinéma
    if ($cinema) {
    return $this->view('cinema/cinema', ['cinema' => $cinema]);
}

// Si aucun cinéma n'a été trouvé avec cet ID, aucun retour n'est effectué (il pourrait être utile d'ajouter un message d'erreur ou une redirection)
}
}
