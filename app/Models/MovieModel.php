<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model
{
    protected $table = 'movies';

    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'release_date', 'duration', 'rating', 'slug', 'description'];


    // Champs de gestion des dates

    public function getMovieById($id)
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id", "left");
        return $this->find($id);
    }


    public function getAllUmovies()
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id", "left");
        return $this->findAll();
    }

    public function getMovieBySlug($slug)
    {
        return $this->where('slug', $slug)->get()->getRowArray();
    }

    public function createMovie($data)
    {
        $data['slug'] = $this->generateUniqueSlug($data['title']);
        return $this->insert($data);

    }

    public function searchItemsByName($searchValue, $limit = 10)
    {
        return $this->select('id, name, slug')
            ->like('name', $searchValue)
            ->limit($limit)
            ->findAll();
    }


    public function updateMovie($data, $id)
    {

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
        return $this->get()->getResultArray();
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

    public function getAllMovieFiltered($data, $active = 1, $perPage = 8)
    {
        $this->select("item.id, item.name, item.slug, media.file_path as default_img_file_path");
        $this->join('media', 'item.id_default_img = media.id', 'left');

    }
}