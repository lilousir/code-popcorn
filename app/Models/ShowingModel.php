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
        $this->join('type_showing', 'type_showing.id = showing.id_type_showing', 'left');
        $this->join('movies', 'movies.id = showing.id_movie', 'left');
        return $this->get()->getResultArray();

    }
    public function getShowingByTheaterId($theater_id) {

        $this->select('showing.*,t.name as theater_name, a.name as auditorium_name, movie.*, media.file_path as preview_url');
        $this->join('auditorium a', 'a.id = showing.auditorium_id', 'inner');
        $this->join('movie', 'showing.movie_id = movie.id', 'inner');
        $this->join('media', 'movie.id = media.entity_id AND media.entity_type = "movie"', 'left');
        $this->join('theater t', 't.id = a.theater_id', 'left');
        $this->where('a.theater_id', $theater_id)->where('showing.date >= NOW()');
        $query = $this->get();
        return $query->getResultArray();
    }
    public function getShowingById($id){

        $this->select('showing.*, type_showing.name, movies.title');
        $this->join('type_showing', 'type_showing.id = showing.id_type_showing','left');
        $this->join('movies', 'movies.id = showing.id_movie','left');
        return $this->where('showing.id', $id)->first();
    }
    public function getShowingByMovieSlug($slug){
        $this->select('showing.date, showing.version');
        $this->join('movies', 'movies.id = showing.id_movie', 'left');
        return $this->where('movies.slug', $slug)->orderBy('showing.date', 'ASC')->get()->getResultArray();

    }
    public function getPaginatedShowing($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select('showing.*, type_showing.name, movies.title');
        $builder->join('type_showing', 'type_showing.id = showing.id_type_showing','left');
        $builder->join('movies', 'movies.id = showing.id_movie','left');
        // Recherche
        if ($searchValue != null) {
            $builder->like('title', $searchValue);
            $this->orLike('name', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function getTotalShowing()
    {

        return $this->countAllResults();
    }



    public function getFilteredShowing($searchValue)
    {
        $builder = $this->builder();
        $builder->select('showing.*, type_showing.name, movies.title');
        $builder->join('type_showing', 'type_showing.id = showing.id_type_showing','left');
        $builder->join('movies', 'movies.id = showing.id_movie','left');

        // @phpstan-ignore-next-line
        if ($searchValue != null) {
            $builder->like('title', $searchValue);
            $builder->orLike('name', $searchValue);
        }

        return $builder->countAllResults();
    }
    public function activateShowing($id) {


        $this->set('deleted_at', NULL);
        $this->where('id', $id);
        return $this->update();
    }

    public function createShowing($data)
    {
        return $this->insert($data);
    }


    public function deleteShowing($id)
    {
        return $this->delete($id);
    }

}