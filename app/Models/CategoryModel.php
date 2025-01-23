<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    // Nom de la table associée au modèle
    protected $table = 'category';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Utilisation de l'auto-incrémentation pour la clé primaire
    protected $useAutoIncrement = true;

    // Désactive la suppression douce (soft delete) pour ce modèle
    protected $useSoftDeletes = false;

    // Protège les champs de la table contre l'insertion ou la modification non autorisée
    protected $protectFields = true;

    // Liste des champs autorisés pour les opérations d'écriture (insert/update)
    protected $allowedFields = ['name', 'slug'];

    // Empêche les insertions avec des données vides
    protected bool $allowEmptyInserts = false;

    // N'effectue les mises à jour que si des champs ont été modifiés
    protected bool $updateOnlyChanged = true;

    /**
     * Récupère une catégorie par son identifiant.
     *
     * @param int $id L'identifiant de la catégorie.
     * @return array|null Les données de la catégorie ou null si introuvable.
     */
    public function getCategoryById($id)
    {
        return $this->find($id);
    }

    /**
     * Récupère toutes les catégories.
     *
     * @return array La liste de toutes les catégories.
     */
    public function getAllCategory()
    {
        return $this->findAll();
    }

    /**
     * Crée une nouvelle catégorie avec un slug unique.
     *
     * @param array $data Les données de la catégorie (nom, etc.).
     * @return bool|int L'identifiant de la catégorie insérée ou false en cas d'échec.
     */
    public function createCategory($data)
    {
        // Génère un slug unique à partir du nom
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        return $this->insert($data);
    }

    /**
     * Met à jour une catégorie existante.
     *
     * @param int $id L'identifiant de la catégorie à mettre à jour.
     * @param array $data Les nouvelles données de la catégorie.
     * @return bool True si la mise à jour réussit, false sinon.
     */
    public function updateCategory($id, $data)
    {
        if (isset($data['name'])) {
            // Met à jour le slug si le nom est modifié
            $data['slug'] = $this->generateUniqueSlug($data['name'], $id);
        }
        return $this->update($id, $data);
    }

    /**
     * Supprime une catégorie.
     *
     * @param int $id L'identifiant de la catégorie à supprimer.
     * @return bool True si la suppression réussit, false sinon.
     */
    public function deleteCategory($id)
    {
        return $this->delete($id);
    }

    /**
     * Récupère les catégories paginées avec des options de recherche et de tri.
     *
     * @param int $start La position de départ pour la pagination.
     * @param int $length Le nombre de catégories à récupérer.
     * @param string|null $searchValue La valeur de recherche pour filtrer les résultats.
     * @param string|null $orderColumnName La colonne par laquelle trier.
     * @param string|null $orderDirection La direction du tri (ASC ou DESC).
     * @return array Les catégories paginées.
     */
    public function getPaginatedCategory($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder(); // Crée une instance du constructeur de requêtes
        $builder->select("category.*"); // Sélectionne toutes les colonnes de la table

        // Applique le filtre de recherche si une valeur est fournie
        if (!empty($searchValue)) {
            $builder->like('category.name', $searchValue);
        }

        // Applique le tri si des colonnes et une direction sont spécifiées
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        // Applique la pagination
        $builder->limit($length, $start);

        // Exécute la requête et retourne les résultats sous forme de tableau
        return $builder->get()->getResultArray();
    }

    /**
     * Récupère le nombre total de catégories.
     *
     * @return int Le nombre total de catégories.
     */
    public function getTotalCategory()
    {
        return $this->countAllResults();
    }

    /**
     * Récupère le nombre total de catégories filtrées par une valeur de recherche.
     *
     * @param string|null $searchValue La valeur de recherche pour filtrer les résultats.
     * @param int|null $limit Le nombre maximum de résultats à récupérer.
     * @param int|null $offset La position de départ pour la pagination.
     * @return array Les catégories filtrées.
     */
    public function getFilteredCategory($searchValue, $limit = null, $offset = null)
    {
        $builder = $this->builder();
        $builder->select("category.*"); // Sélectionne toutes les colonnes de la table

        // Applique le filtre de recherche
        if (!empty($searchValue)) {
            $builder->groupStart();
            $builder->like('category.name', $searchValue);
            $builder->groupEnd();
        }

        // Applique la pagination si des limites sont spécifiées
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }

        // Exécute la requête et retourne les résultats sous forme de tableau
        return $builder->get()->getResultArray();
    }

    /**
     * Génère un slug unique pour une catégorie.
     *
     * @param string $name Le nom de la catégorie.
     * @return string Le slug unique généré.
     */
    private function generateUniqueSlug($name)
    {
        $slug = generateSlug($name); // Génère un slug initial
        $builder = $this->builder();
        $count = $builder->where('slug', $slug)->countAllResults();

        // Si le slug est unique, le retourner directement
        if ($count === 0) {
            return $slug;
        }

        // Si le slug existe déjà, générer une version unique
        $i = 1;
        while ($count > 0) {
            $newSlug = $slug . '-' . $i;
            $count = $builder->where('slug', $newSlug)->countAllResults();
            $i++;
        }
        return $newSlug;
    }
}
