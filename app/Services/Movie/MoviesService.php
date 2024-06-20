<?php

namespace App\Services\Movie;

interface MoviesService
{

    public function addPostMovie($request);

    public function deleteMovie($id);

    public function getMovie($id);

    public function getListPaginationMovieByUser($id,$pagination);

    public function getListPaginationMovie($pagination);

}
