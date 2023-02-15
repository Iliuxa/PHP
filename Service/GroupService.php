<?php

namespace App\Service;

use App\DTO\IdNameDTO;
use App\Entity\GroupEntity;

class GroupService
{
    public function getGroup()
    {
        $dtoArray = [];
        $entityManager = getEntityManager();
        $category = $entityManager->getRepository(GroupEntity::class)->findAll();
        foreach ($category as $item) {
            $dto = new IdNameDTO();
            $dto->id = $item->getId();
            $dto->name = $item->getGroupName();
            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }
}