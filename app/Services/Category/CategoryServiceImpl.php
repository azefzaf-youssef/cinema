<?php

namespace App\Services\Category;

use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Traduction;
use App\Models\Illustration;
use Illuminate\Support\Facades\Hash;

class CategoryServiceImpl implements CategoryService
{

    public function addOrEditPostCategory($request)
    {

        try {

            $category  = ($request->get('id')) ? Category::find($request->get('id')) : new Category() ;
            $category->category = $request->get('category');
            $category->save();

            return response()->json(['message'], 200);

        } catch (\Throwable $th) {

            dd($th);

            return response()->json(['error' => $th], 400);

        }

    }

    public function deleteCategory($id)
    {

        $category = Category::find($id);
        if ($category->delete()) {
            return true;

        }
        return false;

    }


    public function getListCategoryPagination($pagination)
    {
        return Category::whereNotIn('id',[])->paginate($pagination);
    }


    public function getCategory($id)
    {
        return Category::find($id);
    }


}
