<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Langue;
use App\Models\Domaine;
use App\Models\Traduction;
use App\Models\Illustration;
use Illuminate\Http\Request;
use App\Enums\UserPermission;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\IllustrationRequest;
use  App\Services\Illustration\IllustrationService;

class MoviesController extends Controller
{

    private $illustrationService;
    private $data;

    public function __construct(IllustrationService $illustrationService) {
        $this->data = [];
        $this->illustrationService = $illustrationService;
    }

    public function index()
    {
        $data = $this->data ;
        $data['user'] =$user= Auth::user();
        $data['langues'] = Langue::all();
        $data['domaines'] = Domaine::all();
        $data['illustrations'] = $this->illustrationService->getListPaginationIllustrationByUser($user->id,8);

        return view('illustration.index')->with($data);
    }

    public function addPost(IllustrationRequest $request)
    {

        return $this->illustrationService->addPostIllustration($request);

    }

    public function deleteIllustration($titre)
    {
        return response()->json([$this->illustrationService->deleteIllustration($titre)]);

    }

    public function afficherIllustration($titre)
    {

        $data = $this->data ;
        $data['illustration']=$illustration=$this->illustrationService->getIllustration($titre);
        $data['composants'] = json_decode($illustration->getComposantLangueDefaultJson());
        $data['langues'] = Langue::whereNotIn('id',$illustration->getIllustrationTraduction()->pluck('id_langue')->toArray())->get();
        $data['traductions'] = $illustration->getIllustrationTraductionNotDefault();

        return view('illustration.affichage_composant')->with($data);

    }

    public function addComposantIllustration($id)
    {
        $data = $this->data ;
        $data['illustration']=$this->illustrationService->getIllustration($id);
        return view('illustration.add_composant')->with($data);

    }

    public function editComposantIllustration($id)
    {
        $data = $this->data ;
        $data['illustration']=$illustration=$this->illustrationService->getIllustration($id);
        $data['composants'] = json_decode($illustration->getComposantLangueDefaultJson());
        return view('illustration.edit_composant')->with($data);

    }

    public function postAddComposantIllustration(Request $request)
    {

        return $this->illustrationService->addComposants($request);


    }

    public function postEditComposantIllustration(Request $request)
    {

        return $this->illustrationService->editComposants($request);


    }


    public function addTraductionComposantIllustration($id , $id_langue)
    {
        $data = $this->data ;

        $data['illustration']=$illustration=$this->illustrationService->getIllustration($id);
        $data['composants'] = json_decode($illustration->getComposantLangueDefaultJson());
        $data['langue'] = Langue::find($id_langue);

        return view('illustration.traduction.add_traduction_composant')->with($data);

    }


    public function postAddTraductionComposantIllustration(Request $request)
    {

        return $this->illustrationService->addTraductionComposants($request);


    }


    public function editTraductionComposantIllustration($id , $id_langue)
    {
        $data = $this->data ;

        $data['illustration']=$illustration=$this->illustrationService->getIllustration($id);

        $data['composants'] = json_decode($illustration->getComposantLangueJsonById($id_langue));

        $data['langue'] = Langue::find($id_langue);

        return view('illustration.traduction.edit_traduction_composant')->with($data);

    }

    public function postEditTraductionComposantIllustration(Request $request)
    {

        return $this->illustrationService->editTraductionComposants($request);

    }

    public function deleteIllustrationTraduction($id)
    {
        return response()->json([$this->illustrationService->deleteIllustrationTraduction($id)]);

    }

    public function getIllustrationTraduction(Request $request)
    {
        $illustration=$this->illustrationService->getIllustration($request->get('titre'));

        $traduction = Traduction::where('id_illustration',$illustration->id)
        ->where('id_langue' ,$request->get('id_langue'))
        ->first();


        return response()->json(json_decode($illustration->getComposantLangueJsonById($request->get('id_langue'))));

    }
}
