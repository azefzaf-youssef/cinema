<?php

namespace App\Services\Category;

interface CategoryService
{

    public function addOrEditPostCategory($request);

    public function deleteCategory($id);

    public function getListCategoryPagination($pagination);

    public function getCategory($id);


}
