<?php

namespace App\Models;

use CodeIgniter\Model;

class ShowingModel extends Model

{
    protected $table = 'showing';

    protected $primaryKey = 'id';

    protected $allowedFields = ['date', 'description', 'version','id_type_showing','id_movie','deleted_at'];

    protected $useSoftDeletes = true;


    public function getindex(){



    }

}