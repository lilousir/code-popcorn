<?php

namespace App\Models;

use CodeIgniter\Model;

// Modèle pour gérer les opérations liées à la table "auditorium" (salles)
class SalleModel extends Model
{
    // Nom de la table
    protected $table = 'auditorium';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les opérations d'écriture (insert/update)
    protected $allowedFields = ['name', 'capacity', 'theater_id', 'deleted_at'];

    // Activation de la suppression "douce" (soft delete)
    protected $useSoftDeletes = true;

    /**
     * Récupère toutes les salles.
     *
     * @return array
     */
    public function getAllsalle()
    {
        return $this->findAll();
    }

    /**
     * Récupère une salle par son ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getSalleById($id)
    {
        return $this->find($id);
    }

    /**
     * Récupère les salles avec pagination, recherche et tri.
     *
     * @param int $start
     * @param int $length
     * @param string $searchValue
     * @param string $orderColumnName
     * @param string $orderDirection
     * @return array
     */
    public function getPaginatedSalle($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();

        // Recherche
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
            $builder->orLike('theater_id', $searchValue);  // Recherche par le nom ou le theater_id
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);  // Pagination

        return $builder->get()->getResultArray();
    }

    /**
     * Récupère le nombre total de salles.
     *
     * @return int
     */
    public function getTotalSalle()
    {
        $builder = $this->builder();
        return $builder->countAllResults();
    }

    /**
     * Récupère le nombre total de salles filtrées par recherche.
     *
     * @param string $searchValue
     * @return int
     */
    public function getFilteredSalle($searchValue)
    {
        $builder = $this->builder();

        // Recherche par nom ou theater_id
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
            $builder->orLike('theater_id', $searchValue);
        }

        return $builder->countAllResults();
    }

    /**
     * Réactive une salle supprimée (soft delete).
     *
     * @param int $id
     * @return bool
     */
    public function activateSalle($id)
    {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL);  // Réinitialise la date de suppression
        $builder->where('id', $id);
        return $builder->update();
    }

    /**
     * Supprime une salle (soft delete).
     *
     * @param int $id
     * @return bool
     */
    public function deleteSalle($id)
    {
        return $this->delete($id);
    }

    /**
     * Crée une nouvelle salle.
     *
     * @param array $data
     * @return bool|int
     */
    public function createSalle($data)
    {
        return $this->insert($data);
    }

    /**
     * Met à jour une salle.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateSalle($id, $data)
    {
        return $this->update($id, $data);
    }
}
