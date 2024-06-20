<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Langue;
use App\Models\Domaine;
use App\Models\Category;
use App\Models\Traduction;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Enums\UserPermission;
use Illuminate\Http\JsonResponse;
use App\Services\Movie\MoviesService;
use App\Http\Requests\MovieRequest;
use  App\Services\Movie\MovieService;

class MoviesController extends Controller
{

    private $movieService;
    private $data;

    public function __construct(MoviesService $movieService) {
        $this->data = [];
        $this->movieService = $movieService;
    }

    public function index()
    {
        $data = $this->data ;
        $data['user'] =$user= Auth::user();
        $data['categories'] = Category::all();
        $data['movies'] = $this->movieService->getListPaginationMovie(8);

        return view('movies.index')->with($data);
    }

    public function addPost(Request $request)
    {

        return $this->movieService->addPostMovie($request);

    }

    public function deleteMovie($titre)
    {
        return response()->json([$this->movieService->deleteMovie($titre)]);

    }

    public function afficherMovie($titre)
    {

        $data = $this->data ;
        $data['illustration']=$illustration=$this->movieService->getMovie($titre);
        $data['composants'] = json_decode($illustration->getComposantLangueDefaultJson());
        $data['langues'] = Langue::whereNotIn('id',$illustration->getMovieTraduction()->pluck('id_langue')->toArray())->get();
        $data['traductions'] = $illustration->getMovieTraductionNotDefault();

        return view('movies.affichage_composant')->with($data);

    }

}
