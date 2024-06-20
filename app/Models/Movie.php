<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{

    protected $table = 'movies';


    public function categorie()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }


}
