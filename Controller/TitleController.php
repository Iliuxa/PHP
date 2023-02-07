<?php

namespace App\Controller;



use App\Service\TitleServise;

class TitleController
{
    public TitleServise $service;

    public function __construct()
    {
        $this->service = new TitleServise();
    }

    /**
     * Получить все названия льгот
     * @return array
     */
    function getTitle()
    {
        return $this->service->getTitle();
    }
}