<?php

namespace App\Service;

use App\DTO\GroupDTO;
use App\Entity\GroupEntity;

class GroupService
{
    function getGroup()
    {
        $dtoArray = [];
        $entityManager = getEntityManager();
        $category = $entityManager->getRepository(GroupEntity::class)->findAll();
        foreach ($category as $item) {
            $dto = new GroupDTO();
            $dto->groupName = $item->getGroupName();
            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }
}