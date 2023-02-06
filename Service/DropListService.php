<?php

namespace App\Service;

use App\DTO\DropListCategoryDTO;
use App\DTO\DropListGroupDTO;
use App\DTO\DropListTitleDTO;
use App\Entity\CategoryEntity;
use App\Entity\GroupEntity;
use App\Entity\TitleEntity;

class DropListService
{
    function getTitle()
    {
        $dtoArray = [];
        $entityManager = getEntityManager();
        $title = $entityManager->getRepository(TitleEntity::class)->findAll();
        foreach ($title as $item) {
            $dto = new DropListTitleDTO();
            $dto->fullName = $item->getFullName();
            $dto->shortName = $item->getShortName();
            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }

    function getCategory()
    {
        $dtoArray = [];
        $entityManager = getEntityManager();
        $category = $entityManager->getRepository(CategoryEntity::class)->findAll();
        foreach ($category as $item) {
            $dto = new DropListCategoryDTO();
            $dto->categoruName = $item->getCategoryName();
            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }

    function getGroup()
    {
        $dtoArray = [];
        $entityManager = getEntityManager();
        $category = $entityManager->getRepository(GroupEntity::class)->findAll();
        foreach ($category as $item) {
            $dto = new DropListGroupDTO();
            $dto->groupName = $item->getGroupName();
            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }
}