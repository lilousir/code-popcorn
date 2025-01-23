<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeshowingModel extends Model
{
    // Nom de la table associée
    protected $table = 'type_showing';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les opérations d'écriture (insert/update)
    protected $allowedFields = ['name', 'deleted_at'];

    // Activation de la suppression "douce" (soft delete)
    protected $useSoftDeletes = true;

    /**
     * Récupère tous les types de séance.
     *
     * @return array
     */
    public function getAllTypeShowing()
    {
        return $this->findAll(); // Retourne tous les types de séance
    }

    /**
     * Récupère un type de séance par son ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getTypeShowingById($id)
    {
        // Ici, tu fais une erreur dans la requête. La table est `type_showing`, pas `theater`.
        return $this->where('id', $id)->get()->getRowArray();  // Cherche par ID du type de séance
    }
}
