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
}