<?php

namespace App\Service;

use App\DTO\BenefitDTO;
use App\DTO\IdNameDTO;
use App\DTO\IdNameShortDTO;
use App\Entity\TitleEntity;

require_once "bootstrap.php";

class BenefitService
{
    function getAll()
    {
        $entityManager = getEntityManager();
        $dtoArray = [];
        /** @var \App\Entity\BenefitEntity $benefit */
        $benefit = $entityManager->getRepository(\App\Entity\BenefitEntity::class)->findAll();
        foreach ($benefit as $item) {
            $dto = new BenefitDTO();
            $nameDTO = new IdNameDTO();
            $shortNameDTO = new IdNameShortDTO();

            $shortNameDTO->id = $item->getTitle()->getId();
            $shortNameDTO->name = $item->getTitle()->getFullName();
            $shortNameDTO->shortName = $item->getTitle()->getShortName();
            $dto->title = $shortNameDTO;

            $nameDTO->id = $item->getCategory()->getId();
            $nameDTO->name = $item->getCategory()->getCategoryName();
            $dto->category = $nameDTO;

            $nameDTO->id = $item->getGroup()->getId();
            $nameDTO->name = $item->getGroup()->getGroupName();
            $dto->group = $nameDTO;

            $dtoArray[] = $dto;
        }

        header("Content-Type: application\json");
        echo json_encode(['success' => true, 'rows' => $dtoArray]);
    }


    function create(array $request)
    {
        $entityManager = getEntityManager();

        $title = $entityManager->getRepository(TitleEntity::class)->findOneByFullName([$request['full_name']]);
        if ($title == null) {    //делаем новую запись
            $title = new TitleEntity();
            $title->setFullName($request['full_name']);
            $title->setShortName($request['short_name']);
        }

        $category = $entityManager->getRepository(\App\Entity\CategoryEntity::class)->findOneByCategoryName([$request['category_name']]);
        if ($category == null) {    //делаем новую запись
            $category = new \App\Entity\CategoryEntity();
            $category->setCategoryName($request['category_name']);
        }

        $group = $entityManager->getRepository(\App\Entity\GroupEntity::class)->findOneByGroupName([$request['group_name']]);
        if ($group == null) {    //делаем новую запись
            $group = new \App\Entity\GroupEntity();
            $group->setGroupName($request['group_name']);
        }

        try {
            $benefitsNew = new \App\Entity\BenefitEntity();
            $benefitsNew->setTitle($title);
            $benefitsNew->setCategory($category);
            $benefitsNew->setGroup($group);

            $entityManager->persist($title);
            $entityManager->persist($category);
            $entityManager->persist($group);
            $entityManager->persist($benefitsNew);
            $entityManager->flush();

        } catch (\Doctrine\ORM\OptimisticLockException|\Doctrine\ORM\ORMException $e) {
            var_dump($e->getMessage());
            die;
        }

    }
}