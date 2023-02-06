<?php

namespace App\Controller;

use App\Service\BenefitService;

require_once "bootstrap.php";

class BenefitController
{
    function getAll()
    {
        $method = new BenefitService();
        return $method->getAll();
    }

    function create(array $request)
    {
        $method = new BenefitService();
        $method->create($request);
    }

    function modify(array $request)
    {
        $method = new BenefitService();
        $method->modify($request);
    }
}