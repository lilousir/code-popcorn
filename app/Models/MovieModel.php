<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model
{
    protected $table = 'movies';

    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'release_date', 'duration', 'rating', 'slug', 'description', 'id_cat'];



    // Champs de gestion des dates




    public function getAllUmovies()
    {
        return $this->findAll();
    }

    public function createMovie($data)
    {
        return $this->insert($data);
    }
    public function getPaginatedMovie($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {

        return $this->get()->getResultArray();
    }

    // Obtenir le nombre total de cinémas
    public function getTotalMovie()
    {
        return $this->countAllResults();
    }

    // Obtenir le nombre total de cinémas filtrés par recherche
    public function getFilteredMovie($searchValue)
    {

        return $this->countAllResults();
    }

}