<?php

namespace App\Controller;

use App\Service\BenefitService;

require_once "bootstrap.php";

class BenefitController
{
    private BenefitService $service;

    public function __construct()
    {
        $this->service = new BenefitService();
    }

    /**
     * Вывод всех льгот
     * @return array
     */
    public function getAll(): array
    {
        return $this->service->getAll();
    }

    /**
     * Вывод льгот которые действительны в определённый год
     * @param array $request
     * @return array
     */
    public function getValidInYear(array $request)
    {
        return $this->service->getValidInYear($request);
    }

    /**
     * Создание новой льготы
     * @param array $request
     * @return void
     * @throws \Exception
     */
    public function create(array $request)
    {
        $this->service->create($request);
    }

    /**
     * Изменение конкретной льготы
     * @param array $request
     * @return void
     * @throws \Exception
     */
    public function modify(array $request)
    {
        $this->service->modify($request);
    }

}
