<?php

namespace App\Services\Illustration;

interface IllustrationService
{

    public function addPostIllustration($request);

    public function deleteIllustration($id);

    public function getIllustration($id);

    public function getListPaginationIllustrationByUser($id,$pagination);

    public function getListPaginationIllustration($pagination);

    public function addComposants($request);

    public function addTraductionComposants($request);

    public function editTraductionComposants($request);

    public function deleteIllustrationTraduction($id);

}
