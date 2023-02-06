<?php

namespace App\Service;

use App\Constants\Constants;
use App\DTO\BenefitDTO;
use App\DTO\IdNameDTO;
use App\DTO\IdNameShortDTO;
use App\Entity\BenefitEntity;
use App\Entity\CategoryEntity;
use App\Entity\GroupEntity;
use App\Entity\TitleEntity;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

require_once "bootstrap.php";

class BenefitService
{
    function getAll()
    {
        $entityManager = getEntityManager();
        $dtoArray = [];
        /** @var BenefitEntity $benefit */
        $benefit = $entityManager->getRepository(BenefitEntity::class)->findAll();
        foreach ($benefit as $item) {
            $dto = new BenefitDTO();
            $nameDTO = new IdNameDTO();
            $shortNameDTO = new IdNameShortDTO();

            $dto->id = $item->getId();

            $shortNameDTO->id = $item->getTitle()->getId();
            $shortNameDTO->name = $item->getTitle()->getFullName();
            $shortNameDTO->shortName = $item->getTitle()->getShortName();
            $dto->title = $shortNameDTO;


            $nameDTO->id = $item->getCategory()->getId();
            $nameDTO->name = $item->getCategory()->getCategoryName();
            $dto->category = $nameDTO;

            $nameDTO = new IdNameDTO();
            $nameDTO->id = $item->getGroup()->getId();
            $nameDTO->name = $item->getGroup()->getGroupName();
            $dto->group = $nameDTO;

            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }


    function create(array $request)
    {
        foreach ($request as $item) {
            if ($item == '') {
                throw new \Exception('Bad request', Constants::HTTP_BAD_REQUEST);
            }
        }

        $entityManager = getEntityManager();
        try {
            $title = $entityManager->getRepository(TitleEntity::class)->findOneByFullName([$request['full_name']]);
            if ($title == null) {    //делаем новую запись
                $title = new TitleEntity();
                $title->setFullName($request['full_name']);
                $title->setShortName($request['short_name']);
                $entityManager->persist($title);
            }

            $category = $entityManager->getRepository(\App\Entity\CategoryEntity::class)->findOneByCategoryName([$request['category_name']]);
            if ($category == null) {    //делаем новую запись
                $category = new \App\Entity\CategoryEntity();
                $category->setCategoryName($request['category_name']);
                $entityManager->persist($category);
            }

            $group = $entityManager->getRepository(\App\Entity\GroupEntity::class)->findOneByGroupName([$request['group_name']]);
            if ($group == null) {    //делаем новую запись
                $group = new \App\Entity\GroupEntity();
                $group->setGroupName($request['group_name']);
                $entityManager->persist($group);
            }

            $benefitsNew = new BenefitEntity();
            $benefitsNew->setTitle($title);
            $benefitsNew->setCategory($category);
            $benefitsNew->setGroup($group);
            $entityManager->persist($benefitsNew);

            $entityManager->flush();

        } catch (OptimisticLockException|ORMException $e) {
            throw new \Exception('Не удалось создать новую запись.', Constants::INTERNAL_SERVER_ERROR);
        }
    }

    function modify(array $request)
    {
        foreach ($request as $item) {
            if ($item == '') {
                throw new \Exception('Bad request', Constants::HTTP_BAD_REQUEST);
            }
        }
        $entityManager = getEntityManager();
        try {
            /** @var BenefitEntity $benefit */
            $benefit = $entityManager->getRepository(BenefitEntity::class)->findOneById([$request['id']]);
            if ($benefit != null) {
                if ($benefit->getTitle()->getFullName() != $request['full_name']) {
                    $title = $entityManager->getRepository(TitleEntity::class)->findOneByFullName([$request['full_name']]);
                    if ($title == null) {    //делаем новую запись
                        $title = new TitleEntity();
                        $title->setFullName($request['full_name']);
                        $title->setShortName($request['short_name']);
                        $entityManager->persist($title);
                    }
                    $benefit->setTitle($title);
                }
                if ($benefit->getTitle()->getShortName() != $request['short_name']) {
                    $benefit->getTitle()->setShortName($request['short_name']);
                }

                if ($benefit->getCategory()->getCategoryName() != $request['category_name']) {
                    $category = $entityManager->getRepository(CategoryEntity::class)->findOneByCategoryName([$request['category_name']]);
                    if ($category == null) {    //делаем новую запись
                        $category = new CategoryEntity();
                        $category->setCategoryName($request['category_name']);
                        $entityManager->persist($category);
                    }
                    $benefit->setCategory($category);
                }

                if ($benefit->getGroup()->getGroupName() != $request['group_name']) {
                    $group = $entityManager->getRepository(GroupEntity::class)->findOneByGroupName([$request['group_name']]);
                    if ($group == null) {    //делаем новую запись
                        $group = new GroupEntity();
                        $group->setGroupName($request['group_name']);
                        $entityManager->persist($group);
                    }
                    $benefit->setGroup($group);
                }
                $entityManager->persist($benefit);
                $entityManager->flush();
            } else {
                throw new \Exception('Не найдена запись.', Constants::HTTP_NOT_FOUND);
            }

        } catch (OptimisticLockException|ORMException $e) {
            throw new \Exception('Не удалось изменить запись.', Constants::INTERNAL_SERVER_ERROR);
        }
    }
}



















