<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Nom de la table associée
    protected $table = 'user';
    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les opérations d'insertion et de mise à jour
    protected $allowedFields = ['username', 'firstname', 'name', 'email', 'phone', 'dob', 'password', 'id_permission', 'created_at', 'updated_at', 'deleted_at'];

    // Activation de la suppression "douce" (soft delete)
    protected $useSoftDeletes = true;

    // Champs de gestion des dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Règles de validation
    protected $validationRules = [
        'username' => 'required|is_unique[user.username,id,{id}]|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|is_unique[user.email,id,{id}]',
        'password' => 'required|min_length[8]',
        'id_permission' => 'required|is_natural_no_zero',
    ];

    // Messages de validation personnalisés
    protected $validationMessages = [
        'username' => [
            'required'   => 'Le nom d\'utilisateur est requis.',
            'min_length' => 'Le nom d\'utilisateur doit comporter au moins 3 caractères.',
            'max_length' => 'Le nom d\'utilisateur ne doit pas dépasser 100 caractères.',
            'is_unique'  => 'Ce nom d\'utilisateur est déjà utilisé.',
        ],
        'email' => [
            'required'   => 'L\'email est requis.',
            'valid_email' => 'L\'email doit être valide.',
            'is_unique'  => 'Cet email est déjà utilisé.',
        ],
        'password' => [
            'required'   => 'Le mot de passe est requis.',
            'min_length' => 'Le mot de passe doit comporter au moins 8 caractères.',
        ],
        'id_permission' => [
            'required'          => 'La permission est requise.',
            'is_natural_no_zero' => 'La permission doit être un entier positif.',
        ],
    ];

    // Callbacks pour le hachage du mot de passe avant l'insertion ou la mise à jour
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Fonction de hachage du mot de passe
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data; // Ne fait rien si le mot de passe est absent
        }

        // Hachage du mot de passe avant de le sauvegarder
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    // Relation avec la table des permissions
    public function getPermissions()
    {
        return $this->join('user_permission', 'user.id_permission = user_permission.id')
            ->select('user.*, user_permission.name as permission_name')
            ->findAll();
    }

    // Récupère un utilisateur avec ses informations supplémentaires, comme l'avatar
    public function getUserById($id)
    {
        $this->select('user.*, media.file_path as avatar_url');
        $this->join('media', 'user.id = media.entity_id AND media.entity_type = "user"', 'left');
        return $this->find($id); // Retourne l'utilisateur
    }

    // Récupère tous les utilisateurs
    public function getAllUsers()
    {
        return $this->findAll(); // Retourne tous les utilisateurs
    }

    // Crée un nouvel utilisateur
    public function createUser($data)
    {
        return $this->insert($data); // Insère les données de l'utilisateur
    }

    // Met à jour un utilisateur
    public function updateUser($id, $data)
    {
        $builder = $this->builder();
        if (isset($data['password'])) {
            if($data['password'] == '') {
                unset($data['password']); // Si le mot de passe est vide, on ne le met pas à jour
            } else {
                // Sinon, on le hache
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
        }
        $builder->where('id', $id); // Sélectionne l'utilisateur par ID
        return $builder->update($data); // Met à jour les informations
    }

    // Supprime un utilisateur
    public function deleteUser($id)
    {
        return $this->delete($id); // Supprime l'utilisateur par ID
    }

    // Compte le nombre d'utilisateurs par permission
    public function countUserByPermission()
    {
        $builder = $this->db->table('user U');
        $builder->select('UP.name, count(U.id) as count');
        $builder->join('user_permission UP', 'U.id_permission = UP.id');
        $builder->groupBy('U.id_permission');
        return $builder->get()->getResultArray(); // Retourne le résultat sous forme de tableau
    }

    // Active un utilisateur en supprimant la date de suppression douce
    public function activateUser($id)
    {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL); // Annule la suppression douce
        $builder->where('id', $id); // Sélectionne l'utilisateur par ID
        return $builder->update(); // Met à jour l'utilisateur
    }

    // Vérifie le login d'un utilisateur
    public function verifyLogin($email, $password)
    {
        // Recherche l'utilisateur par email, incluant les utilisateurs supprimés
        $user = $this->withDeleted()->where('email', $email)->first();

        // Si l'utilisateur existe et que le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            return $user; // L'utilisateur est valide
        }

        return false; // Si l'utilisateur ou le mot de passe est incorrect
    }

    // Récupère les utilisateurs avec pagination
    public function getPaginatedUser($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->join('user_permission', 'user.id_permission = user_permission.id', 'left');
        $builder->join('media', 'user.id = media.entity_id AND media.entity_type = "user"', 'left');
        $builder->select('user.*, user_permission.name as permission_name, media.file_path as avatar_url');

        // Recherche
        if ($searchValue != null) {
            $builder->like('username', $searchValue);
            $builder->orLike('email', $searchValue);
            $builder->orLike('user_permission.name', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start); // Limite la pagination

        return $builder->get()->getResultArray(); // Retourne les résultats
    }

    // Compte le total des utilisateurs
    public function getTotalUser()
    {
        $builder = $this->builder();
        $builder->join('user_permission', 'user.id_permission = user_permission.id');
        return $builder->countAllResults(); // Retourne le nombre total d'utilisateurs
    }

    // Récupère le nombre d'utilisateurs filtrés par une valeur de recherche
    public function getFilteredUser($searchValue)
    {
        $builder = $this->builder();
        $builder->join('user_permission', 'user.id_permission = user_permission.id', 'left');
        $builder->join('media', 'user.id = media.entity_id AND media.entity_type = "user"', 'left');
        $builder->select('user.*, user_permission.name as permission_name, media.file_path as avatar_url');

        if (!empty($searchValue)) {
            $builder->like('username', $searchValue);
            $builder->orLike('email', $searchValue);
            $builder->orLike('user_permission.name', $searchValue);
        }

        return $builder->countAllResults(); // Retourne le nombre d'utilisateurs filtrés
    }
}
