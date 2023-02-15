<?php

namespace App\Service;

use App\Entity\TitleEntity;
use App\DTO\IdNameShortDTO;

class TitleServise
{
    public function getTitle()
    {
        $dtoArray = [];
        $entityManager = getEntityManager();
        $title = $entityManager->getRepository(TitleEntity::class)->findAll();
        foreach ($title as $item) {
            $dto = new IdNameShortDTO();
            $dto->id = $item->getId();
            $dto->name = $item->getFullName();
            $dto->shortName = $item->getShortName();
            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }
}