<?php

namespace App\Services\Movies;

use App\Models\movie;
use App\Models\Traduction;
use Auth;

class MoviesServiceImpl implements MoviesService
{

    public function addPostmovie($request)
    {

        try {

            $movie = new movie();
            $path = 'public/movies/' . date('y-m-d');
            $rs = \Storage::putFile($path, $request->file('movie'));
            $rs = str_replace("public", "storage", $rs);
            $movie->path_movie = $rs;
            $movie->titre = $request->get('titre');
            $movie->id_langue = $request->get('langue');
            $movie->id_domaine = $request->get('domaine');
            $movie->id_user = Auth::user()->id;

            $movie->save();

            return response()->json(['message'], 200);

        } catch (\Throwable $th) {

            return response()->json(['error' => $th], 400);

        }

    }

    public function deletemovie($titre)
    {

        $movie = $this->getmovie($titre);
        Traduction::where('id_movie', $movie->id)->delete();
        if ($movie->delete()) {
            return true;

        }
        return false;

    }

    public function deletemovieTraduction($id)
    {

        $traduction = Traduction::find($id);
        if ($traduction->delete()) {
            return true;

        }
        return false;

    }

    public function getmovie($titre)
    {
        return movie::where('titre', $titre)->first();
    }

    public function getListPaginationmovieByUser($id, $pagination)
    {
        return movie::where('id_user', $id)->paginate($pagination);
    }

    public function getListPaginationmovie($pagination)
    {
        if (Auth::user()) {

            if (Auth::user()->is_admin) {

                return movie::paginate($pagination);

            } else {

                $ids_movie = array_unique(Traduction::get()->pluck('id_movie')->toArray());
                return movie::whereIn('id', $ids_movie)->paginate($pagination);

            }

        } else {

            $ids_movie = array_unique(Traduction::get()->pluck('id_movie')->toArray());

            return movie::whereIn('id', $ids_movie)->paginate($pagination);

        }

    }

x
}
