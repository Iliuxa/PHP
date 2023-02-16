<?php

namespace App\Controller;

use App\Service\GroupService;

class GroupController
{
    private GroupService $service;

    public function __construct()
    {
        $this->service = new GroupService();
    }

    /**
     * Получить все группы льгот
     * @return array
     */
    public function getGroup()
    {
        $method = new GroupService();
        return $this->service->getGroup();
    }
}