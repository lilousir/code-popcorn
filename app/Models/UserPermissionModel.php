<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPermissionModel extends Model
{
    // Nom de la table de la base de données
    protected $table = 'user_permission';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les opérations d'insertion et de mise à jour
    protected $allowedFields = ['name', 'slug'];

    // Règles de validation pour les données
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]', // Le champ 'name' doit être requis et avoir une longueur entre 3 et 100 caractères
    ];

    // Messages d'erreur de validation personnalisés
    protected $validationMessages = [
        'name' => [
            'required'   => 'Le nom de la permission est requis.',
            'min_length' => 'Le nom de la permission doit comporter au moins 3 caractères.',
            'max_length' => 'Le nom de la permission ne doit pas dépasser 100 caractères.',
        ],
    ];

    // Crée une nouvelle permission avec un slug unique
    public function createPermission($data)
    {
        // Si le champ 'name' est défini, on génère un slug unique pour la permission
        if (isset($data['name'])) {
            // Générer le slug unique basé sur le nom
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        }

        // Insérer la permission dans la base de données
        return $this->insert($data);
    }

    // Met à jour une permission existante avec un nouveau slug unique
    public function updatePermission($id, $data)
    {
        // Si le champ 'name' est défini, on génère un slug unique pour la permission
        if (isset($data['name'])) {
            // Générer le slug unique basé sur le nom
            $data['slug'] = $this->generateUniqueSlug($data['name']);
        }

        // Mettre à jour la permission dans la base de données
        return $this->update($id, $data);
    }

    // Générer un slug unique en vérifiant l'existence de slugs similaires dans la base de données
    private function generateUniqueSlug($name)
    {
        // Générer un slug de base à partir du nom
        $slug = generateSlug($name);
        $builder = $this->builder();

        // Vérifier si un slug similaire existe déjà
        $count = $builder->where('slug', $slug)->countAllResults();

        // Si aucun slug similaire n'est trouvé, retourner le slug
        if ($count === 0) {
            return $slug;
        }

        // Si le slug existe déjà, ajouter un suffixe numérique pour garantir son unicité
        $i = 1;
        while ($count > 0) {
            // Ajouter un suffixe numérique au slug
            $newSlug = $slug . '-' . $i;
            // Vérifier si le nouveau slug existe déjà
            $count = $builder->where('slug', $newSlug)->countAllResults();
            $i++; // Incrémenter le suffixe numérique
        }

        // Retourner le slug unique
        return $newSlug;
    }

    // Récupérer tous les utilisateurs associés à une permission spécifique
    public function getUsersByPermission($permissionId)
    {
        // Joindre la table des utilisateurs à celle des permissions et récupérer les utilisateurs associés
        return $this->join('TableUser', 'TableUserPermission.id = TableUser.id_permission')
            ->where('TableUserPermission.id', $permissionId)
            ->select('TableUser.*, TableUserPermission.name as permission_name') // Sélectionner les utilisateurs et le nom de la permission
            ->findAll(); // Retourner tous les résultats
    }

    // Récupérer toutes les permissions
    public function getAllPermissions()
    {
        return $this->findAll(); // Retourner toutes les permissions de la table
    }

    // Récupérer une permission par son ID
    public function getUserPermissionById($id)
    {
        return $this->find($id); // Retourner la permission correspondant à l'ID
    }

    // Supprimer une permission par son ID
    public function deletePermission($id)
    {
        return $this->delete($id); // Supprimer la permission correspondante
    }

    // Récupérer les permissions avec pagination et recherche
    public function getPaginatedPermission($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();

        // Appliquer la recherche par nom de permission si une valeur de recherche est fournie
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
        }

        // Appliquer le tri si des colonnes et directions de tri sont spécifiées
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        // Appliquer la limite pour la pagination
        $builder->limit($length, $start);

        // Retourner les résultats paginés sous forme de tableau
        return $builder->get()->getResultArray();
    }

    // Récupérer le nombre total de permissions
    public function getTotalPermission()
    {
        $builder = $this->builder();
        return $builder->countAllResults(); // Retourner le nombre total de permissions dans la table
    }

    // Récupérer le nombre de permissions filtrées par une valeur de recherche
    public function getFilteredPermission($searchValue)
    {
        $builder = $this->builder();

        // Appliquer le filtre de recherche si une valeur de recherche est fournie
        if (!empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        // Retourner le nombre de permissions filtrées
        return $builder->countAllResults();
    }
}
