<?php

namespace App\Models;

use App\Models\User;
use App\Models\Langue;
use App\Models\Domaine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Illustration extends Model
{

    protected $table = 'illustration';

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    public function domaine()
    {
        return $this->belongsTo(Domaine::class, 'id_domaine');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getComposantLangueDefaultJson()
    {
        $defaultLangue = Traduction::where('id_illustration',$this->id)->where('default',true)->first();

        if($defaultLangue)
        {
            return $defaultLangue->composants_json;
        }
        return '[]';
    }

    public function getComposantLangueJsonById($id)
    {
        $traduction = Traduction::where('id_illustration',$this->id)
        ->where('id_langue' ,$id)
        ->first();

        if($traduction)
        {
            return $traduction->composants_json;
        }
        return '[]';
    }

    public function getComposantLangueDefault()
    {

        return Traduction::where('id_illustration',$this->id)->where('default',true)->get();

    }

    public function getIllustrationTraduction()
    {
        return Traduction::where('id_illustration',$this->id)
        ->leftJoin("langue", "langue.id", "=", "traduction.id_langue")
        ->leftJoin("users", "users.id", "=", "traduction.id_user")
        ->select([
            'traduction.id as id',
            'traduction.id_langue as id_langue',
            'langue.langue as langue',
            'users.name as name',
        ])
        ->get();
    }

    public function getIllustrationTraductionNotDefault()
    {
        return Traduction::where('id_illustration',$this->id)
        ->leftJoin("langue", "langue.id", "=", "traduction.id_langue")
        ->leftJoin("users", "users.id", "=", "traduction.id_user")
        ->where('default',false)
        ->select([
            'traduction.id as id',
            'traduction.id_langue as id_langue',
            'langue.langue as langue',
            'users.name as name',
            'traduction.id_user as id_user',
        ])
        ->get();
    }
}
