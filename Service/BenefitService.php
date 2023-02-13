<?php

namespace App\Service;

use App\Constants\Constants;
use App\DTO\BenefitDTO;
use App\Entity\BenefitEntity;
use App\Entity\CategoryEntity;
use App\Entity\GroupEntity;
use App\Entity\TitleEntity;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Util\Debug;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use DateTime;

use Doctrine\ORM\Query\ResultSetMapping;

require_once "bootstrap.php";

class BenefitService
{
    function getValidInYear()
    {
        $entityManager = getEntityManager();

        $year = DateTime::createFromFormat('Y', $_GET['year']);
        $year->setDate($year->format('Y'), 1, 1);
        $year->setTime(0, 0, 0);

        $year1 = clone $year;
        $year1->modify("+1 year");

        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->orX(
            Criteria::expr()->andX(
                Criteria::expr()->gt('b.startDate', $year), Criteria::expr()->lt('b.startDate', $year1)
            ),
            Criteria::expr()->andX(
                Criteria::expr()->gt('b.endDate', $year), Criteria::expr()->lt('b.endDate', $year1)
            ),
            Criteria::expr()->andX(
                Criteria::expr()->lt('b.startDate', $year), Criteria::expr()->gt('b.endDate', $year1)
            ),
        ));

        $qb = $entityManager->createQueryBuilder();
        $qb->select('b')
            ->from(BenefitEntity::class, 'b')
            ->addCriteria($criteria);

        $query = $qb->getQuery()->getResult();

        $dtoArray = $this->createDTO($query, true);
        return $dtoArray;
    }

    //==================Работает======NativeSQL======================//

//        $q = "select t.full_name , t.short_name , c.category_name ,g.group_name, b.start_date, b.end_date, b.special_right,
//b.advantage_right, b.base_vi, b.special_base_vi, b.bvi, b.active
//from benefits b
//inner join title t ON b.id_title = t.id_title
//inner join category c ON b.id_category  = c.id_category
//inner join group_ g ON b.id_group  = g.id_group
//where  ((to_date('2022-01-01', 'YYYY-MM-DD') < b.start_date and  b.start_date < to_date('2023-01-01', 'YYYY-MM-DD'))
//or  (to_date('2022-01-01', 'YYYY-MM-DD') < b.end_date and b.end_date < to_date('2023-01-01', 'YYYY-MM-DD')))";
//         $query = $entityManager->getConnection()->executeQuery($q)->fetchAllAssociative()


    function getAll()
    {
        $entityManager = getEntityManager();
        $benefit = $entityManager->getRepository(BenefitEntity::class)->findAll();
        $dtoArray = $this->createDTO($benefit, false);
        return $dtoArray;
    }

    function create(array $request)
    {
        foreach ($request as $item) {
            if (empty($item)) {
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

            $benefitsNew->setStartDate(DateTime::createFromFormat('d.m.Y', $request['start_date']));
            $benefitsNew->setEndDate(DateTime::createFromFormat('d.m.Y', $request['end_date']));

            $benefitsNew->setSpecialRight(!$request['special_right'] == null);
            $benefitsNew->setAdvantageRight(!($request['advantage_right'] == null));
            $benefitsNew->setBaseVI(!($request['base_VI'] == null));
            $benefitsNew->setSpecialBaseVI(!($request['special_base_VI'] == null));
            $benefitsNew->setBvi(!($request['bvi'] == null));

            $today = new DateTime('now');
            $benefitsNew->setActive($today > $benefitsNew->getStartDate() && $today < $benefitsNew->getEndDate());

            $entityManager->persist($benefitsNew);
            $entityManager->flush();

        } catch (OptimisticLockException|ORMException $e) {
            throw new \Exception('Не удалось создать новую запись.', Constants::HTTP_INTERNAL_SERVER_ERROR);
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

                $benefit->setStartDate(DateTime::createFromFormat('d.m.Y', $request['start_date']));
                $benefit->setEndDate(DateTime::createFromFormat('d.m.Y', $request['end_date']));

                $benefit->setSpecialRight(!$request['special_right'] == null);
                $benefit->setAdvantageRight(!($request['advantage_right'] == null));
                $benefit->setBaseVI(!($request['base_VI'] == null));
                $benefit->setSpecialBaseVI(!($request['special_base_VI'] == null));
                $benefit->setBvi(!($request['bvi'] == null));

                $today = new DateTime('now');
                $benefit->setActive($today > $benefit->getStartDate() && $today < $benefit->getEndDate());

                $entityManager->persist($benefit);
                $entityManager->flush();
            } else {
                throw new \Exception('Не найдена запись.', Constants::HTTP_NOT_FOUND);
            }

        } catch (OptimisticLockException|ORMException $e) {
            throw new \Exception('Не удалось изменить запись.', Constants::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    function createDTO($query, $active)
    {
        foreach ($query as $item) {
            $dto = new BenefitDTO();
            $dto->id = $item->getId();

            $dto->title->id = $item->getTitle()->getId();
            $dto->title->name = $item->getTitle()->getFullName();
            $dto->title->shortName = $item->getTitle()->getShortName();

            $dto->category->id = $item->getCategory()->getId();
            $dto->category->name = $item->getCategory()->getCategoryName();

            $dto->group->id = $item->getGroup()->getId();
            $dto->group->name = $item->getGroup()->getGroupName();

            $dto->startDate = $item->getStartDate()->format('d.m.Y');
            $dto->endDate = $item->getEndDate()->format('d.m.Y');
            $dto->specialRight = $item->getSpecialRight();
            $dto->advantageRight = $item->getAdvantageRight();
            $dto->baseVI = $item->getBaseVI();
            $dto->specialBaseVI = $item->getSpecialBaseVI();
            $dto->bvi = $item->getBvi();
            if ($active) {
                $dto->active = true;
            } else {
                $dto->active = $item->getActive();
            }

            $dtoArray[] = $dto;
        }
        return $dtoArray;
    }
}



















