<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Langue;
use App\Models\Traduction;
use App\Models\Illustration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UtilisateurRequest;
use App\Http\Requests\IllustrationRequest;
use App\Services\Category\CategoryService;
use App\Services\Illustration\IllustrationService;

class CategoryController extends Controller
{

    private $categoryService;
    private $data;

    public function __construct(CategoryService $categoryService) {
        $this->middleware('auth');
        $this->data = [];
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $data = $this->data ;
        $data['categories'] = $this->categoryService->getListCategoryPagination(8) ;

        return view('category.index')->with($data);
    }

    public function postCategory(CategoryRequest $request)
    {

        return $this->categoryService->addOrEditPostCategory($request);

    }


    public function editCategory($id)
    {
        $data = $this->data ;
        $data['category']=$illustration=$this->categoryService->getCategory($id);
        return view('category.modifier')->with($data);

    }

    public function deleteCategory($id)
    {
        return response()->json([$this->categoryService->deleteCategory($id)]);

    }


}
