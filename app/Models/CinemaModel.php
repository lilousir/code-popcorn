<?php

namespace App\Models;

use CodeIgniter\Model;

class CinemaModel extends Model
{
    // Nom de la table associée au modèle
    protected $table = 'theater';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les opérations d'écriture
    protected $allowedFields = ['id', 'name', 'address', 'phone', 'email', 'id_city'];

    // Désactive l'utilisation automatique des timestamps (created_at, updated_at, etc.)
    protected $useTimestamps = false;

    /**
     * Récupère tous les cinémas avec les données de média, paginés.
     *
     * @param array $data Les paramètres pour filtrer les données.
     * @param int $perPage Le nombre d'éléments par page.
     * @return array Les cinémas paginés.
     */
    public function getAllMovieFiltered($data, $perPage = 8)
    {
        $builder = $this->builder();
        $builder->select("theater.*, media.file_path as photo_url");
        $builder->join("media", "media.entity_id = theater.id AND media.entity_type = 'theater'", "left");
        return $this->paginate($perPage);
    }

    /**
     * Récupère tous les cinémas avec les données de média.
     *
     * @return array La liste complète des cinémas.
     */
    public function getAlltheater()
    {
        $this->select("theater.*, media.file_path as photo_url");
        $this->join("media", "media.entity_id = theater.id AND media.entity_type = 'theater'", "left");
        return $this->findAll();
    }

    /**
     * Récupère un cinéma par son identifiant avec ses données média.
     *
     * @param int $id L'identifiant du cinéma.
     * @return array|null Les données du cinéma ou null si introuvable.
     */
    public function getTheatersById($id)
    {
        $builder = $this->builder();
        $builder->select("theater.*, media.file_path as photo_url");
        $builder->join("media", "media.entity_id = theater.id AND media.entity_type = 'theater'", "left");
        return $this->where('theater.id', $id)->get()->getRowArray();
    }

    /**
     * Crée un nouveau cinéma.
     *
     * @param array $data Les données du cinéma.
     * @return bool|int L'identifiant inséré ou false en cas d'échec.
     */
    public function createCinema($data)
    {
        return $this->insert($data);
    }

    /**
     * Met à jour un cinéma existant.
     *
     * @param array $data Les nouvelles données du cinéma.
     * @param int $id L'identifiant du cinéma à mettre à jour.
     * @return bool True si la mise à jour réussit, false sinon.
     */
    public function updateCinema($data, $id)
    {
        return $this->update($data, $id);
    }

    /**
     * Récupère les cinémas paginés avec recherche et tri.
     *
     * @param int $start La position de départ pour la pagination.
     * @param int $length Le nombre d'éléments à récupérer.
     * @param string|null $searchValue La valeur de recherche pour filtrer les résultats.
     * @param string|null $orderColumnName La colonne utilisée pour le tri.
     * @param string|null $orderDirection La direction du tri (ASC ou DESC).
     * @return array Les cinémas paginés avec les données filtrées.
     */
    public function getPaginatedCinema($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select("theater.*, media.file_path as photo_url");
        $builder->join("media", "media.entity_id = theater.id AND media.entity_type = 'theater'", "left");
        $builder->join('city', 'theater.id_city = city.id', 'left'); // Jointure avec la table city
        $builder->select('theater.*, city.label'); // Sélectionne les champs nécessaires

        // Ajout d'un filtre de recherche si un terme est spécifié
        if (!empty($searchValue)) {
            $builder->like('theater.name', $searchValue);
            $builder->orLike('theater.email', $searchValue);
            $builder->orLike('city.label', $searchValue);
        }

        // Application du tri si des colonnes et une direction sont spécifiées
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        // Application de la pagination
        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    /**
     * Récupère le nombre total de cinémas.
     *
     * @return int Le nombre total de cinémas.
     */
    public function getTotalCinema()
    {
        $builder = $this->builder();
        $builder->select("theater.*, media.file_path as photo_url");
        $builder->join("media", "media.entity_id = theater.id AND media.entity_type = 'theater'", "left");
        $builder->join('city', 'theater.id_city = city.id', 'left'); // Jointure avec la table city
        $builder->select('theater.*, city.label'); // Sélectionne les champs nécessaires
        return $this->countAllResults();
    }

    /**
     * Récupère le nombre total de cinémas filtrés par recherche.
     *
     * @param string|null $searchValue La valeur de recherche.
     * @param int|null $limit Limite pour la pagination.
     * @param int|null $offset Décalage pour la pagination.
     * @return int Le nombre total de cinémas correspondant aux critères.
     */
    public function getFilteredCinema($searchValue, $limit = null, $offset = null)
    {
        $builder = $this->builder();
        $builder->select("theater.*, media.file_path as photo_url");
        $builder->join("media", "media.entity_id = theater.id AND media.entity_type = 'theater'", "left");
        $builder->join('city', 'theater.id_city = city.id', 'left');

        // Ajout du filtre de recherche
        if (!empty($searchValue)) {
            $builder->like('theater.name', $searchValue);
            $builder->orLike('theater.email', $searchValue);
            $builder->orLike('city.label', $searchValue);
        }

        return $this->countAllResults();
    }
}
