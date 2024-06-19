<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Langue;
use App\Models\Traduction;
use App\Models\Illustration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UtilisateurRequest;
use App\Http\Requests\IllustrationRequest;
use App\Services\Utilisateur\UtilisateurService;
use App\Services\Illustration\IllustrationService;

class UtilisateurController extends Controller
{

    private $utilisateurService;
    private $data;

    public function __construct(UtilisateurService $utilisateurService) {
        $this->middleware('auth');
        $this->data = [];
        $this->utilisateurService = $utilisateurService;
    }

    public function index()
    {
        $data = $this->data ;
        $data['user'] =$user= Auth::user();
        $data['langues'] = Langue::all();
        $data['users'] = $this->utilisateurService->getListUtilisateursIllustration(8) ;

        return view('utilisateur.index')->with($data);
    }

    public function postUtilisateur(UtilisateurRequest $request)
    {

        return $this->utilisateurService->addOrEditPostUtilisateur($request);

    }


    public function editUtilisateur($id)
    {
        $data = $this->data ;
        $data['user']=$illustration=$this->utilisateurService->getUtilisateur($id);
        return view('utilisateur.modifier')->with($data);

    }

    public function deleteUtilisateur($id)
    {
        return response()->json([$this->utilisateurService->deleteUtilisateur($id)]);

    }



    public function afficherIllustration($id)
    {

        $data = $this->data ;
        $data['illustration']=$illustration=$this->utilisateurService->getIllustration($id);
        $data['composants'] = json_decode($illustration->getComposantLangueDefaultJson());
        $data['langues'] = Langue::whereNotIn('id',$illustration->getIllustrationTraduction()->pluck('id_langue')->toArray())->get();
        $data['traductions'] = $illustration->getIllustrationTraductionNotDefault();

        return view('illustration.affichage_composant')->with($data);

    }

    public function addComposantIllustration($id)
    {
        $data = $this->data ;
        $data['illustration']=$this->utilisateurService->getIllustration($id);
        return view('illustration.add_composant')->with($data);

    }

    public function editComposantIllustration($id)
    {
        $data = $this->data ;
        $data['illustration']=$illustration=$this->utilisateurService->getIllustration($id);
        $data['composants'] = json_decode($illustration->getComposantLangueDefaultJson());
        return view('illustration.edit_composant')->with($data);

    }

    public function postAddComposantIllustration(Request $request)
    {

        return $this->utilisateurService->addComposants($request);


    }

    public function postEditComposantIllustration(Request $request)
    {

        return $this->utilisateurService->editComposants($request);


    }


    public function addTraductionComposantIllustration($id , $id_langue)
    {
        $data = $this->data ;

        $data['illustration']=$illustration=$this->utilisateurService->getIllustration($id);
        $data['composants'] = json_decode($illustration->getComposantLangueDefaultJson());
        $data['langue'] = Langue::find($id_langue);

        return view('illustration.traduction.add_traduction_composant')->with($data);

    }


    public function postAddTraductionComposantIllustration(Request $request)
    {

        return $this->utilisateurService->addTraductionComposants($request);


    }


    public function editTraductionComposantIllustration($id , $id_langue)
    {
        $data = $this->data ;

        $data['illustration']=$illustration=$this->utilisateurService->getIllustration($id);

        $data['composants'] = json_decode($illustration->getComposantLangueJsonById($id_langue));

        $data['langue'] = Langue::find($id_langue);

        return view('illustration.traduction.edit_traduction_composant')->with($data);

    }

    public function postEditTraductionComposantIllustration(Request $request)
    {

        return $this->utilisateurService->editTraductionComposants($request);

    }

    public function deleteIllustrationTraduction($id)
    {
        return response()->json([$this->utilisateurService->deleteIllustrationTraduction($id)]);

    }

    public function getIllustrationTraduction(Request $request)
    {
        $traduction = Traduction::where('id_illustration',$request->get('id'))
        ->where('id_langue' ,$request->get('id_langue'))
        ->first();

        $illustration=$this->utilisateurService->getIllustration($request->get('id'));

        return response()->json(json_decode($illustration->getComposantLangueJsonById($request->get('id_langue'))));

    }
}
