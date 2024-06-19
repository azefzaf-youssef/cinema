<?php

namespace App\Services\Utilisateur;

interface UtilisateurService
{

    public function addOrEditPostUtilisateur($request);

    public function deleteUtilisateur($id);

    public function getListUtilisateursIllustration($pagination);

    public function getUtilisateur($id);


}
