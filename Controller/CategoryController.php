<?php

namespace App\Controller;

use App\Service\CategoryServise;

class CategoryController
{
    public CategoryServise $service;

    public function __construct()
    {
        $this->service = new CategoryServise();
    }

    /**
     * Получить все категории льгот
     * @return array
     */
    function getCategory()
    {
        return $this->service->getCategory();
    }
}