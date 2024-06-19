<?php

namespace App\Services\Utilisateur;

use Auth;
use App\Models\User;
use App\Models\Traduction;
use App\Models\Illustration;
use Illuminate\Support\Facades\Hash;

class UtilisateurServiceImpl implements UtilisateurService
{

    public function addOrEditPostUtilisateur($request)
    {

        try {

            $user  = ($request->get('id')) ? User::find($request->get('id')) : new User() ;
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->save();

            return response()->json(['message'], 200);

        } catch (\Throwable $th) {

            dd($th);

            return response()->json(['error' => $th], 400);

        }

    }

    public function deleteUtilisateur($id)
    {

        $user = User::find($id);
        if ($user->delete()) {
            return true;

        }
        return false;

    }


    public function getListUtilisateursIllustration($pagination)
    {
        return User::where('is_admin',false)->paginate($pagination);
    }


    public function getUtilisateur($id)
    {
        return User::find($id);
    }


}
