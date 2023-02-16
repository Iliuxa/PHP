<html>
<body>
<form method="POST" action="api.php?act=Benefit&method=create">
    <input type="text" name="full_name" placeholder="Enter full name"> <br>
    <input type="text" name="short_name" placeholder="Enter short name "> <br>
    <input type="text" name="category_name" placeholder="Enter category name"> <br>
    <input type="text" name="group_name" placeholder="Enter group name"> <br>
    <input type="text" name="start_date" placeholder="Enter start date"> <br>
    <input type="text" name="end_date" placeholder="Enter end date"> <br>

    <input type="checkbox" name="special_right" >special right<Br>
    <input type="checkbox" name="advantage_right"  >advantage right<Br>
    <input type="checkbox" name="base_VI" >base VI<Br>
    <input type="checkbox" name="special_base_VI" >special base VI<Br>
    <input type="checkbox" name="bvi" >BVI<Br>



    <button type="submit">Send</button>
    <br>
</body>
</html>

<?php

// use App\Entity\TitleEntity;

// //register_shutdown_function(function () {
// //    var_dump(error_get_last());
// //    die;
// //});
// require_once "bootstrap.php";

// $entityManager = getEntityManager();

// $title = $entityManager->getRepository(TitleEntity::class)->findOneByFullName([$_POST['full_name']]);
// if ($title == null) {    //делаем новую запись
//     $title = new TitleEntity();
//     $title->setFullName($_POST['full_name']);
//     $title->setShortName($_POST['short_name']);
// }

// $category = $entityManager->getRepository(\App\Entity\CategoryEntity::class)->findOneByCategoryName([$_POST['category_name']]);
// if ($category == null) {    //делаем новую запись
//     $category = new \App\Entity\CategoryEntity();
//     $category->setCategoryName($_POST['category_name']);
// }

// $group = $entityManager->getRepository(\App\Entity\GroupEntity::class)->findOneByGroupName([$_POST['group_name']]);
// if ($group == null) {    //делаем новую запись
//     $group = new \App\Entity\GroupEntity();
//     $group->setGroupName($_POST['group_name']);
// }

// try {
//     $benefitsNew = new \App\Entity\BenefitEntity();
//     $benefitsNew->setTitle($title);
//     $benefitsNew->setCategory($category);
//     $benefitsNew->setGroup($group);

//     $entityManager->persist($title);
//     $entityManager->persist($category);
//     $entityManager->persist($group);
//     $entityManager->persist($benefitsNew);
//     $entityManager->flush();

// } catch (\Doctrine\ORM\OptimisticLockException|\Doctrine\ORM\ORMException $e) {
//     var_dump($e->getMessage());
//     die;
// }


//$count = $entityManager->getRepository(TitleEntity::class)->count([]);
//var_dump($count); die;
//$qb = $entityManager -> createQueryBuilder();
//$qb ->select('t.fullName')
//    ->from(TitleEntity::class, 't');
//$query = $qb->getQuery()->getResult();
//var_dump($query);




//$repository = $entityManager->getRepository(TitleEntity::class)->findByFullName('cc');
//var_dump($repository);
//die;


//$title = new TitleEntity();
//$title->setFullName($_POST['full_name']);
//$title->setShortName($_POST['short_name']);
//
//
//try {
//    $entityManager->persist($title);
//    $entityManager->flush();
//} catch (\Doctrine\ORM\OptimisticLockException|\Doctrine\ORM\ORMException $e) {
//    var_dump($e->getMessage());
//    die;
//}

/*$requests = ['select * from title', 'select * from category', 'select * from group_'];
$requestsOut = ['insert into title values ( :id, :name, :fname)', 'insert into category values ( :id, :name)', 'insert into group_ values ( :id, :name)'];

$title = [$_POST['full_name'], $_POST['short_name']];
$category = [$_POST['category_name']];
$group = [$_POST['group_name']];

$inp = [$title, $category, $group];

$areFieldsEmpty = true;
foreach ($inp as $x) {
    if ($x[0] == '') {
        $areFieldsEmpty = false;
        echo "Заполните все поля!";
        break;
    }
}

if ($areFieldsEmpty) {
    try {
        $dbh = new PDO('pgsql:host=localhost; dbname=postgres', "postgres", "root", [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $benefits_count_x = ($dbh->query('select count(id_benefits)  from benefits ')->fetchAll(PDO::FETCH_NUM))[0];
        $benefits_count = $benefits_count_x[0] + 1;
        $outB = [$benefits_count];
        for ($i = 0; $i < 3; $i++) {
            $counter = 0;
            $id = 1;
            foreach ($dbh->query($requests[$i])->fetchAll(PDO::FETCH_NUM) as $row) {
                if ($row[1] == $inp[$i][0]) {
                    array_push($outB, $row[0]);
                    $counter = 1;
                    break;
                }
                $id++;
            }

            if ($counter == 0) {
                array_push($outB, $id);
                $query = $dbh->prepare($requestsOut[$i]);
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->bindParam(':name', $inp[$i][0], PDO::PARAM_STR);
                if ($i == 0) {
                    $query->bindParam(':fname', $title[1], PDO::PARAM_STR);
                }
                $query->execute();

                $counter = 0;
            }
        }

        $query = $dbh->prepare('insert into benefits values ( :a1, :a2, :a3, :a4)');
        $query->bindParam('a1', $outB[0], PDO::PARAM_INT);
        $query->bindParam('a2', $outB[1], PDO::PARAM_INT);
        $query->bindParam('a3', $outB[2], PDO::PARAM_INT);
        $query->bindParam('a4', $outB[3], PDO::PARAM_INT);
        $query->execute();
       // $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage() . "<br/>";
        die();
    }
}*/
?>