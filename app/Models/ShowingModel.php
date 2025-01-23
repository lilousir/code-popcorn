<?php

namespace App\Models;

use CodeIgniter\Model;

// Modèle pour gérer les opérations liées à la table "showing" (séances de cinéma)
class ShowingModel extends Model
{
    // Nom de la table
    protected $table = 'showing';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les opérations d'écriture (insert/update)
    protected $allowedFields = ['date', 'description', 'version', 'id_movie', 'deleted_at', 'created_at', 'updated_at'];

    // Activation de la suppression "douce" (soft delete)
    protected $useSoftDeletes = true;

    /**
     * Récupère toutes les séances avec le titre des films.
     *
     * @return array
     */
    public function getAllShowing()
    {
        $this->select('showing.*, movies.title');
        $this->join('movies', 'movies.id = showing.id_movie', 'left');
        return $this->get()->getResultArray();
    }

    /**
     * Récupère les séances d'un théâtre donné.
     *
     * @param int $theater_id
     * @return array
     */
    public function getShowingByTheaterId($theater_id)
    {
        $this->select('showing.*, t.name as theater_name, a.name as auditorium_name, movie.*, media.file_path as preview_url');
        $this->join('auditorium a', 'a.id = showing.auditorium_id', 'inner');
        $this->join('movie', 'showing.movie_id = movie.id', 'inner');
        $this->join('media', 'movie.id = media.entity_id AND media.entity_type = "movie"', 'left');
        $this->join('theater t', 't.id = a.theater_id', 'left');
        $this->where('a.theater_id', $theater_id)->where('showing.date >= NOW()');
        $query = $this->get();
        return $query->getResultArray();
    }

    /**
     * Récupère une séance par son ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getShowingById($id)
    {
        $this->select('showing.*, movies.title');
        $this->join('movies', 'movies.id = showing.id_movie', 'left');
        return $this->where('showing.id', $id)->first();
    }

    /**
     * Récupère les séances d'un film donné par son slug.
     *
     * @param string $slug
     * @return array
     */
    public function getShowingByMovieSlug($slug)
    {
        $this->select('showing.date, showing.version');
        $this->join('movies', 'movies.id = showing.id_movie', 'left');
        return $this->where('movies.slug', $slug)->orderBy('showing.date', 'ASC')->get()->getResultArray();
    }

    /**
     * Récupère les séances avec pagination, recherche et tri.
     *
     * @param int $start
     * @param int $length
     * @param string $searchValue
     * @param string $orderColumnName
     * @param string $orderDirection
     * @return array
     */
    public function getPaginatedShowing($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select('showing.*, movies.title');
        $builder->join('movies', 'movies.id = showing.id_movie', 'left');

        // Recherche
        if ($searchValue != null) {
            $builder->like('title', $searchValue);  // Recherche par titre
            $this->orLike('name', $searchValue);    // Recherche par auditorium name
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);  // Pagination

        return $builder->get()->getResultArray();
    }

    /**
     * Récupère le nombre total de séances.
     *
     * @return int
     */
    public function getTotalShowing()
    {
        return $this->countAllResults();
    }

    /**
     * Récupère le nombre total de séances filtrées par recherche.
     *
     * @param string $searchValue
     * @return int
     */
    public function getFilteredShowing($searchValue)
    {
        $builder = $this->builder();
        $builder->select('showing.*, movies.title');
        $builder->join('movies', 'movies.id = showing.id_movie', 'left');

        // Recherche par titre ou auditorium name
        if ($searchValue != null) {
            $builder->like('title', $searchValue);
            $builder->orLike('name', $searchValue);
        }

        return $builder->countAllResults();
    }

    /**
     * Réactive une séance supprimée (soft delete).
     *
     * @param int $id
     * @return bool
     */
    public function activateShowing($id)
    {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL);  // Réinitialise la date de suppression
        $builder->where('id', $id);
        return $builder->update();
    }

    /**
     * Supprime une séance (soft delete).
     *
     * @param int $id
     * @return bool
     */
    public function deleteShowing($id)
    {
        return $this->delete($id);
    }

    /**
     * Crée une nouvelle séance après validation de l'existence du film et de l'auditorium.
     *
     * @param array $data
     * @return bool
     */
    public function createShowing($data)
    {
        // Vérification que le film existe dans la table `movies`
        $movieModel = model('MovieModel');
        if (!$movieModel->find($data['id_movie'])) {
            return false; // Retourne false si le film n'existe pas
        }

        // Vérification que l'auditorium existe dans la table `auditorium`
        $salleModel = model('SalleModel');
        if (!$salleModel->find($data['id_auditorium'])) {
            return false;
        }
        $cinemaModel = model('CinemaModel');
        if (!$cinemaModel->find($data['id_theater'])) {
            return false;
        }

        // Insère la séance après validation
        return $this->insert($data);
    }
}
