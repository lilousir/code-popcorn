<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeshowingModel extends Model

{
    protected $table = 'type_showing';

    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'deleted_at'];

    protected $useSoftDeletes = true;

//pas dans le controlleur
public function getAllTypeShowing(){

    return $this->findAll();
}
public function getTypeShowingById($id)
    {

        return $this->where('theater.id', $id)->get()->getRowArray();

    }
}