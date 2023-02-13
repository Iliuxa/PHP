<?php

namespace App\Controller;

use App\Service\BenefitService;
use App\Service\PDFService;

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
     * Вывод льгот которые действительны в определённый год
     * @return array
     */
    function getValidInYear()
    {
        return $this->service->getValidInYear();
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
