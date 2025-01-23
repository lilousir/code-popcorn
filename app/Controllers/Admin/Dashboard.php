<?php

namespace App\Controllers\Admin;

// Importation du contrôleur de base
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    // Propriétés de la classe
    protected $title = 'Dashboard';        // Déclare un titre par défaut pour cette section
    protected $require_auth = true;       // Indique que l'authentification est requise pour accéder à ce contrôleur

    // Méthode pour afficher la page principale du tableau de bord
    public function getIndex(): string
    {
        // Charge la vue située à `/admin/dashboard/index.php`
        // Les paramètres sont un tableau de données vide et l'option `true` pour activer une fonctionnalité (comme le rendu de gabarits)
        return $this->view('/admin/dashboard/index.php', [], true);
    }

    // Méthode de test, qui démontre l'utilisation de différentes fonctions liées aux messages utilisateur
    public function getTest() {
        // Envoie un message d'erreur
        $this->error("Oh");

        // Envoie un message général
        $this->message("Oh");

        // Envoie un message de succès
        $this->success("Oh");

        // Envoie un message d'avertissement
        $this->warning("Oh");

        // Envoie un autre message d'erreur
        $this->error("Oh");

        // Redirige l'utilisateur vers la route "/Admin/Dashboard"
        $this->redirect("/Admin/Dashboard");
    }
}
