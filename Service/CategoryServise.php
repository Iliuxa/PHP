<?php

namespace App\Service;

use App\DTO\IdNameDTO;
use App\Entity\CategoryEntity;

class CategoryServise
{
    public function getCategory()
    {
        $dtoArray = [];
        $entityManager = getEntityManager();
        $category = $entityManager->getRepository(CategoryEntity::class)->findAll();
        foreach ($category as $item) {
            $dto = new IdNameDTO;
            $dto->id = $item->getId();
            $dto->name = $item->getCategoryName();
            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }
}