<?php

namespace App\Services\Movie;

use App\Models\movie;
use App\Models\Traduction;
use Auth;

class MoviesServiceImpl implements MoviesService
{

    public function addPostMovie($request)
    {

        try {

            $movie = new movie();

            $path = 'public/movies/' . date('y-m-d');
            $rs = \Storage::putFile($path, $request->file('fiche'));
            $rs = str_replace("public", "storage", $rs);
            $movie->path_fiche = $rs;

            $path_trailer = 'public/movies/trailer' . date('y-m-d');
            $rs_trailer = \Storage::putFile($path, $request->file('trailer'));
            $rs_trailer = str_replace("public", "storage", $rs);
            $movie->path_trailer = $rs_trailer;

            $movie->titre = $request->get('titre');
            $movie->description = $request->get('description');

            $movie->date = $request->get('date');
            $movie->heure = $request->get('heure');

            $movie->id_category = $request->get('category');

            $movie->save();

            return response()->json(['message'], 200);

        } catch (\Throwable $th) {

            dd($th);
            return response()->json(['error' => $th], 400);

        }

    }

    public function deleteMovie($id)
    {

        $movie = $this->getmovie($id);
        if ($movie->delete()) {
            return true;

        }
        return false;

    }


    public function getMovie($id)
    {
        return movie::where('id', $id)->first();
    }

    public function getListPaginationMovieByUser($id, $pagination)
    {
        return movie::where('id_user', $id)->paginate($pagination);
    }

    public function getListPaginationMovie($pagination)
    {


            return movie::whereNotIn('id', [])->paginate($pagination);

    }


}
