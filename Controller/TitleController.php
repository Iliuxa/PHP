<?php

namespace App\Controller;



use App\Service\TitleServise;

class TitleController
{
    private TitleServise $service;

    public function __construct()
    {
        $this->service = new TitleServise();
    }

    /**
     * Получить все названия льгот
     * @return array
     */
    public function getTitle()
    {
        return $this->service->getTitle();
    }
}