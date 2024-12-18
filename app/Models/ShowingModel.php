<?php

namespace App\Models;

use CodeIgniter\Model;

class ShowingModel extends Model

{
    protected $table = 'showing';

    protected $primaryKey = 'id';

    protected $allowedFields = ['date', 'description', 'version','id_type_showing','id_movie','deleted_at'];

    protected $useSoftDeletes = true;


    public function getAllShowing(){

        $this->select('showing.*, type_showing.name, movies.title');
        $this->join('type_showing', 'type_showing.id = showing.id_type_showing','left');
        $this->join('movies', 'movies.id = showing.id_movie','left');
        return $this->findAll();

    }
    public function getPaginatedShowing($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {

        $this->select('showing.*, type_showing.name, movies.title');
        $this->join('type_showing', 'type_showing.id = showing.id_type_showing','left');
        $this->join('movies', 'movies.id = showing.id_movie','left');
        // Recherche
        if ($searchValue != null) {
            $this->like('title', $searchValue);
            $this->orLike('name', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $this->orderBy($orderColumnName, $orderDirection);
        }

        $this->limit($length, $start);

        return $this->get()->getResultArray();
    }

    public function getTotalShowing()
    {

        return $this->countAllResults();
    }



    public function getFilteredShowing($searchValue)
    {
        $this->select('showing.*, type_showing.name, movies.title');
        $this->join('type_showing', 'type_showing.id = showing.id_type_showing','left');
        $this->join('movies', 'movies.id = showing.id_movie','left');

        // @phpstan-ignore-next-line
        if ($searchValue != null) {
            $this->like('title', $searchValue);
            $this->orLike('name', $searchValue);
        }

        return $this->countAllResults();
    }
    public function activateShowing($id) {
        $builder = $this->builder();
        $builder->set('deleted_at', NULL);
        $builder->where('id', $id);
        return $builder->update();
    }


    public function deleteShowing($id)
    {
        return $this->delete($id);
    }

}