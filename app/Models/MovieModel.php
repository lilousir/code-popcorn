<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model
{
    protected $table = 'movies';

    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'release_date', 'duration', 'rating', 'slug', 'description','deleted_at'];

    protected $useSoftDeletes = true;
    // Champs de gestion des dates

    public function getMovieById($id)
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id", "left");
        return $this->find($id);
    }
    public function activateMovie($id) {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL);
        $builder->where('id', $id);
        return $builder->update();
    }
    public function deleteMovie($id)
    {
        return $this->delete($id);
    }


    public function getAllMovieFiltered($data,$perPage = 8)
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id", "left");
        return $this->paginate($perPage);
    }

    public function getMovieBySlug($slug)
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id", "left");
        return $this->where('slug', $slug)->get()->getRowArray();
    }

    public function createMovie($data)
    {
        $data['slug'] = $this->generateUniqueSlug($data['title']);
        return $this->insert($data);

    }

    public function searchMovieByName($searchValue, $limit = 10)
    {
        return $this->select('id, title, slug')
            ->like('title', $searchValue)
            ->limit($limit)
            ->findAll();
    }


    public function updateMovie($data, $id)
    {
        if(isset($data['title'])){
        $data['slug'] = $this->generateUniqueSlug($data['title'], $id);

        }
        return $this->update($data, $id);


    }

    private function generateUniqueSlug($name)
    {
        $slug = generateSlug($name);
        $builder = $this->builder();
        $count = $builder->where('slug', $slug)->countAllResults();
        if ($count === 0) {
            return $slug;
        }
        $i = 1;
        while ($count > 0) {
            $newSlug = $slug . '-' . $i;
            $count = $builder->where('slug', $newSlug)->countAllResults();
            $i++;
        }
        return $newSlug;
    }

    public function getPaginatedMovie($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id", "left");

        if (!empty($searchValue)) {
            $builder->like('title', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    // Obtenir le nombre total de cinémas
    public function getTotalMovie()
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id", "left");
        return $this->countAllResults();
    }

    // Obtenir le nombre total de cinémas filtrés par recherche
    public function getFilteredMovie($searchValue)
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id", "left");

        return $this->countAllResults();
    }

}