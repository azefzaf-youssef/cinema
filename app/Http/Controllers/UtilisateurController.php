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




}
