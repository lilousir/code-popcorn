<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'category';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name','slug'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Callbacks

    public function getCategoryById($id){
        return $this->find($id);
    }

    public function getAllCategory(){
        return $this->findAll();
    }
    public function createCategory($data){
        $data['slug'] = $this->generateUniqueSlug($data['name']);

        return $this->insert($data);
    }

    public function updateCategory($id,$data){
        if(isset($data['name'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $id);
        }
        return $this->update($id,$data);
    }
    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
    public function getPaginatedCategory($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select("category.*");

        // Recherche
        if (!empty($searchValue)) {
            $builder->like('category.name', $searchValue);

        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    // Obtenir le nombre total de cinémas
    public function getTotalCategory()
    {
        return $this->countAllResults();
    }

    // Obtenir le nombre total de cinémas filtrés par recherche
    public function getFilteredCategory($searchValue, $limit = null, $offset = null)
    {
        $builder = $this->builder();
        $builder->select("category.*");

        // Filtrage
        if (!empty($searchValue)) {
            $builder->groupStart();
            $builder->like('category.name', $searchValue);
            $builder->groupEnd();
        }

        // Pagination
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }

        return $builder->get()->getResultArray(); // Retourne les données
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

}