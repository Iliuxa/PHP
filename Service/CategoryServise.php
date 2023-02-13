<?php

namespace App\Service;

use App\DTO\CategoryDTO;
use App\Entity\CategoryEntity;

class CategoryServise
{
    function getCategory()
    {
        $dtoArray = [];
        $entityManager = getEntityManager();
        $category = $entityManager->getRepository(CategoryEntity::class)->findAll();
        foreach ($category as $item) {
            $dto = new CategoryDTO();
            $dto->categoruName = $item->getCategoryName();
            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }
}