<?php

namespace App\Models;

use CodeIgniter\Model;

// Modèle pour gérer les opérations liées à la table "movies"
class MovieModel extends Model
{
    // Nom de la table
    protected $table = 'movies';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les opérations d'écriture (insert/update)
    protected $allowedFields = ['title', 'release_date', 'duration', 'rating', 'slug', 'description', 'deleted_at'];

    // Activation de la suppression "douce" (soft delete)
    protected $useSoftDeletes = true;

    /**
     * Récupère tous les films.
     * @return array
     */
    public function getAllMovies()
    {
        return $this->findAll();
    }

    /**
     * Récupère un film par son ID et joint l'affiche associée.
     *
     * @param int $id
     * @return array|null
     */
    public function getMovieById($id)
    {
        $this->select("movies.*, media.file_path as affiche_url");
        $this->join("media", "media.entity_id = movies.id and media.entity_type = 'movie'", "left");
        return $this->find($id);
    }

    /**
     * Réactive un film supprimé (soft delete).
     *
     * @param int $id
     * @return bool
     */
    public function activateMovie($id)
    {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL); // Réinitialise la date de suppression
        $builder->where('id', $id);
        return $builder->update();
    }

    /**
     * Supprime un film (soft delete).
     *
     * @param int $id
     * @return bool
     */
    public function deleteMovie($id)
    {
        return $this->delete($id);
    }

    /**
     * Valide les données d'un film avant insertion/mise à jour.
     *
     * @param array $data
     * @return object Instance de validation
     */
    public function validateMovie($data)
    {
        $validation = \Config\Services::validation();

        // Définition des règles de validation
        $validation->setRules([
            'title' => 'required|min_length[3]|max_length[255]',
            'release_date' => 'required|valid_date[Y-m-d]',
            'duration' => 'required|is_natural_no_zero',
            'rating' => 'required|greater_than[0]|less_than[11]',
            'description' => 'required|min_length[10]',
            'slug' => 'required|alpha_dash|is_unique[movies.slug]',
        ]);

        // Validation de l'image de l'affiche
        if (empty($data['affiche_image']) || !$data['affiche_image']->isValid()) {
            $validation->setError('affiche_image', 'L\'affiche du film est obligatoire.');
        }

        return $validation;
    }

    /**
     * Récupère les films avec filtrage et pagination.
     *
     * @param array $data Données de filtrage.
     * @param int $perPage Nombre de films par page.
     * @return array
     */
    public function getAllMovieFiltered($data, $perPage = 8)
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id and media.entity_type = 'movie'", "left");
        return $this->paginate($perPage);
    }

    /**
     * Récupère un film par son slug.
     *
     * @param string $slug
     * @return array|null
     */
    public function getMovieBySlug($slug)
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id and media.entity_type = 'movie'", "left");
        return $this->where('slug', $slug)->get()->getRowArray();
    }

    /**
     * Crée un nouveau film avec un slug unique.
     *
     * @param array $data
     * @return bool|int
     */
    public function createMovie($data)
    {
        $data['slug'] = $this->generateUniqueSlug($data['title']);
        return $this->insert($data);
    }

    /**
     * Recherche un film par son titre.
     *
     * @param string $searchValue
     * @param int $limit
     * @return array
     */
    public function searchMovieByName($searchValue, $limit = 10)
    {
        return $this->select('id, title, slug')
            ->like('title', $searchValue)
            ->limit($limit)
            ->findAll();
    }

    /**
     * Met à jour un film avec un slug unique si le titre est modifié.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateMovie($id, $data)
    {
        if (isset($data['title'])) {
            $data['slug'] = $this->generateUniqueSlug($data['title'], $id);
        }
        return $this->update($id, $data);
    }

    /**
     * Génère un slug unique pour un film.
     *
     * @param string $name
     * @return string
     */
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

    /**
     * Récupère les films avec pagination, recherche et tri.
     *
     * @param int $start
     * @param int $length
     * @param string $searchValue
     * @param string $orderColumnName
     * @param string $orderDirection
     * @return array
     */
    public function getPaginatedMovie($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select("movies.*, media.file_path as affiche_url");
        $builder->join("media", "media.entity_id = movies.id and media.entity_type = 'movie'", "left");

        if (!empty($searchValue)) {
            $builder->like('title', $searchValue);
        }

        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    /**
     * Récupère le nombre total de films.
     *
     * @return int
     */
    public function getTotalMovie()
    {
        $builder = $this->builder();
        return $this->countAllResults();
    }

    /**
     * Récupère le nombre total de films filtrés par recherche.
     *
     * @param string $searchValue
     * @return int
     */
    public function getFilteredMovie($searchValue)
    {
        $builder = $this->builder();
        return $this->countAllResults();
    }
}
