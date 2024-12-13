<?php

namespace App\Models;


use CodeIgniter\Model;

class SalleModel extends Model
{
    protected $table = 'auditorium';

    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'capacity', 'theater_id','deleted_at'];

    protected $useSoftDeletes = true;



    public function getAllsalle (){
        return $this->findAll();
    }
    public function getSalleById($id){
        return $this->find($id);
    }

    public function getPaginatedSalle($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();

        // Recherche
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
            $builder->orLike('theater_id', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function getTotalSalle()
    {
        $builder = $this->builder();

        return $builder->countAllResults();
    }



    public function getFilteredSalle($searchValue)
    {
        $builder = $this->builder();

        // @phpstan-ignore-next-line
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
            $builder->orLike('theater_id', $searchValue);
        }

        return $builder->countAllResults();
    }
    public function activateSalle($id) {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL);
        $builder->where('id', $id);
        return $builder->update();
    }


    public function deleteSalle($id)
    {
        return $this->delete($id);
    }
    public function createSalle($data)
    {
        return $this->insert($data);
    }
    public function updateSalle( $id,$data){
        return $this->update($id, $data);
    }





}
