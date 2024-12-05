<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryMovieModel extends Model
{
    protected $table = 'category_movie';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_movie', 'id_category'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getAllCategoryMovieByIdMovie($id_movie) {
        return $this->where('id_movie', $id_movie)->findAll();
    }
    public function getAllFullMovieCategorieByIdMovie($id_movie) {
        $builder = $this->db->table('category_movie cm');
        $builder->select("cm.id_category, c.name, c.slug");
        $builder->join("category c", "cm.id_category = c.id");
        $builder->where("cm.id_movie", $id_movie);
        return $builder->get()->getResultArray();
    }
    public function getTotalItemByGenreId($id_category) {
        return $this->select('COUNT(*) as total')->where('id_category', $id_category)->first();
    }
}