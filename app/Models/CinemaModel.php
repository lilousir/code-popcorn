<?php

namespace App\Models;

use CodeIgniter\Model;

class CinemaModel extends Model
{
    protected $table = 'theater';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'address', 'phone', 'email', 'id_city'];

    // Champs de gestion des dates
    protected $useTimestamps = false;

    // Récupérer tous les cinémas
    public function getAllTheaters()
    {
        return $this->findAll();
    }
    public function createCinema($data)
    {
        return $this->insert($data);
    }

    // Récupérer les cinémas paginés avec recherche et tri
    public function getPaginatedCinema($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->join('city', 'theater.id_city = city.id', 'left'); // Jointure avec la table city
        $builder->select('theater.*, city.name as city_name'); // Sélectionner les champs nécessaires

        // Recherche
        if (!empty($searchValue)) {
            $builder->like('theater.name', $searchValue);
            $builder->orLike('theater.email', $searchValue);
            $builder->orLike('city.name', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    // Obtenir le nombre total de cinémas
    public function getTotalCinema()
    {
        return $this->countAllResults();
    }

    // Obtenir le nombre total de cinémas filtrés par recherche
    public function getFilteredCinema($searchValue)
    {
        $builder = $this->builder();
        $builder->join('city', 'theater.id_city = city.id', 'left'); // Jointure avec la table city
        $builder->select('theater.*, city.name as city_name'); // Sélectionner les champs nécessaires


        // Filtrage
        if (!empty($searchValue)) {
            $builder->like('theater.name', $searchValue);
            $builder->orLike('theater.email', $searchValue);
            $builder->orLike('city.name', $searchValue);
        }

        return $builder->countAllResults();
    }
}
