<?php

namespace App\Models;

use App\Controllers\BaseController; // Inclusion du contrôleur de base, bien que non utilisé ici
use CodeIgniter\Model;

class CityModel extends Model
{
    // Nom de la table associée au modèle
    protected $table = 'city';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les opérations d'écriture
    protected $allowedFields = ['id', 'label', 'zip_code'];

    // Désactive l'utilisation automatique des timestamps (created_at, updated_at, etc.)
    protected $useTimestamps = false;

    /**
     * Récupère toutes les villes.
     *
     * @return array Liste complète des villes dans la table `city`.
     */
    public function getAllCity()
    {
        return $this->findAll(); // Retourne toutes les données de la table `city`
    }

    /**
     * Recherche des villes par leur nom ou leur code postal.
     *
     * @param string $searchValue La valeur recherchée (nom ou code postal).
     * @param int $limit Le nombre maximum de résultats à retourner (par défaut 10).
     * @return array Les villes correspondant à la recherche sous forme de tableau.
     */
    public function searchCityByName($searchValue, $limit = 10)
    {
        // Création d'un constructeur de requête pour interagir avec la table `city`
        $builder = $this->db->table('city');

        // Recherche les villes dont le label (nom) contient la valeur recherchée
        $builder->like('label', $searchValue);

        // Recherche également les villes dont le code postal contient la valeur recherchée
        $builder->orLike('zip_code', $searchValue);

        // Exécute la requête
        $query = $builder->get();

        // Retourne les résultats sous forme de tableau associatif
        return $query->getResultArray();
    }
}
