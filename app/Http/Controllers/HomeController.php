<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Langue;
use  App\Services\Illustration\IllustrationService;


class HomeController extends Controller
{
    private $illustrationService;
    private $data;

    public function __construct(IllustrationService $illustrationService) {
        $this->data = [];
        $this->illustrationService = $illustrationService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->data ;
        $data['illustrations'] = $this->illustrationService->getListPaginationIllustration(8);
        return view('home')->with($data);
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

}
