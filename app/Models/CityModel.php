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
        return $this->select('id, label') // Assure-toi d'utiliser 'name' ici
        ->like('label', $searchValue)  // Recherche dans le champ 'name'
        ->limit($limit)               // Limiter à 10 résultats par défaut
        ->findAll();
    }
}