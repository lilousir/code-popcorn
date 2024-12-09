<?php

namespace App\Models;

use App\Controllers\BaseController;
use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = 'city';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'zip'];

    // Champs de gestion des dates
    protected $useTimestamps = false;

    // Récupérer tous les cinémas
    public function getAllCity()
    {
        return $this->findAll();
    }
    public function searchCityByName($searchValue, $limit = 10)
    {
        // On effectue la requête sur la base de données
        $builder = $this->db->table('city');
        $builder->like('label', $searchValue); // On recherche les villes dont le nom contient $searchValue
        $builder->orLike('zip_code', $searchValue); // On recherche les villes dont le nom contient $searchValue
        $query = $builder->get();

        return $query->getResultArray(); // Retourne les résultats sous forme de tableau
    }
}