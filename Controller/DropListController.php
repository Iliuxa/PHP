<?php

namespace App\Controller;

use App\Service\DropListService;

class DropListController
{
    function getTitle()
    {
        $method = new DropListService();
        $method->getTitle();
    }
    function getCategory()
    {
        $method = new DropListService();
        $method->getCategory();
    }
    function getGroup()
    {
        $method = new DropListService();
        $method->getGroup();
    }
}