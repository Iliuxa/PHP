<?php

namespace App\Service;

use App\DTO\TitleDTO;
use App\Entity\TitleEntity;

class TitleServise
{
    function getTitle()
    {
        $dtoArray = [];
        $entityManager = getEntityManager();
        $title = $entityManager->getRepository(TitleEntity::class)->findAll();
        foreach ($title as $item) {
            $dto = new TitleDTO();
            $dto->fullName = $item->getFullName();
            $dto->shortName = $item->getShortName();
            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }
}