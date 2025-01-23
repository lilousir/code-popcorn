<?php

namespace App\Controllers\Admin;

// Importation du contrôleur de base
use App\Controllers\BaseController;

class Home extends BaseController
{
    // Propriétés de la classe
    protected $title = 'Tableau de Bord';               // Définit le titre par défaut pour cette section
    protected $require_auth = true;                    // Indique que l'accès nécessite une authentification
    protected $requiredPermissions = ['administrateur']; // Précise que seuls les utilisateurs avec le rôle 'administrateur' peuvent accéder

    /**
     * Méthode pour afficher la page principale du tableau de bord
     *
     * @return string Retourne le contenu de la vue principale
     */
    public function getindex(): string
    {
        // Instancie le modèle UserModel pour interagir avec les utilisateurs
        $um = Model("App\Models\UserModel");

        // Récupère le nombre d'utilisateurs par type de permission (par exemple, administrateurs, modérateurs, etc.)
        $infosUser = $um->countUserByPermission();

        // Charge la vue du tableau de bord en passant les données récupérées
        return $this->view('/admin/dashboard/index.php', ['infosUser' => $infosUser], true);
    }

    /**
     * Méthode pour afficher une page d'accès interdit
     *
     * @return string Retourne le contenu de la vue pour la page "Accès interdit"
     */
    public function getforbidden(): string
    {
        // Charge la vue située dans `/templates/forbidden.php` pour afficher une page d'accès interdit
        return view('/templates/forbidden');
    }
}
