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

    protected $afterDelete = [];

    public function getAllFullMovieCategorieByIdMovie($id_movie) {
        $builder = $this->db->table('category_movie cm');
        $builder->select("cm.id_category, c.name, c.slug");
        $builder->join("category c", "cm.id_category = c.id");
        $builder->where("cm.id_movie", $id_movie);
        return $builder->get()->getResultArray();
    }
    public function getTotalMovieByCategoryId($id_category) {
        return $this->select('COUNT(*) as total')->where('id_category', $id_category)->first();
    }
}