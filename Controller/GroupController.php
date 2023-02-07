<?php

namespace App\Controller;

use App\Service\GroupService;

class GroupController
{
    public GroupService $service;

    public function __construct()
    {
        $this->service = new GroupService();
    }

    /**
     * Получить все группы льгот
     * @return array
     */
    function getGroup()
    {
        $method = new GroupService();
        return $this->service->getGroup();
    }
}