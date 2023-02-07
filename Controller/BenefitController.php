<?php

namespace App\Controller;

use App\Service\BenefitService;

require_once "bootstrap.php";

class BenefitController
{
    public BenefitService $service;

    public function __construct()
    {
        $this->service = new BenefitService();
    }

    /**
     * Вывод всех льгот
     * @return array
     */
    function getAll(): array
    {
        return $this->service->getAll();
    }

    /**
     * Создание новой льготы
     * @param array $request
     * @return void
     * @throws \Exception
     */
    function create(array $request)
    {
        $this->service->create($request);
    }

    /**
     * Изменение конкретной льготы
     * @param array $request
     * @return void
     * @throws \Exception
     */
    function modify(array $request)
    {
        $this->service->modify($request);
    }
}
