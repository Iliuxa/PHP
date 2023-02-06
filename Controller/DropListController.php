<?php

namespace App\Controller;

use App\Service\DropListService;

class DropListController
{
    function getTitle()
    {
        $method = new DropListService();
        return $method->getTitle();
    }
    function getCategory()
    {
        $method = new DropListService();
        return $method->getCategory();
    }
    function getGroup()
    {
        $method = new DropListService();
        return $method->getGroup();
    }
}