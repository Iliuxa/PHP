<?php

// для отладки

// register_shutdown_function(function(){
//     var_dump(error_get_last());
//     die;
// });

// var_dump(); die;
// https://www.php.net/manual/en/pdo.connections.php
//x

use App\Entity\TitleEntity;

//register_shutdown_function(function () {
//    var_dump(error_get_last());
//    die;
//});

require_once "bootstrap.php";

$entityManager = getEntityManager();
$dtoArray = [];

/** @var \App\Entity\BenefitEntity $benefit */
$benefit = $entityManager->getRepository(\App\Entity\BenefitEntity::class)->findAll();
foreach ($benefit as $item) {
    $dto = new App\DTO\BenefitDTO();
    $dto->fullName = $item->getTitle()->getFullName();
    $dto->shortName = $item->getTitle()->getShortName();
    $dto->category = $item->getCategory()->getCategoryName();
    $dto->group = $item->getGroup()->getGroupName();
    $dtoArray[] = $dto;
}

    header("Content-Type: application\json");
    echo json_encode(['success' => true, 'rows' => $dtoArray]);



///** @var  $benefit */
///** @var \App\Entity\BenefitEntity $benefit */
//$benefit = $entityManager->getRepository(\App\Entity\BenefitEntity::class)->find(1);
///** @var \App\Entity\GroupEntity $group */
//$group = $benefit->getGroup();
//
//var_dump($benefit->getGroup());
//die;

//$query = 'select t.full_name , t.short_name , c.category_name ,g.group_name
//from benefits b
//inner join title t ON b.id_title = t.id_title
//inner join category c ON b.id_category  = c.id_category
//inner join group_ g ON b.id_group  = g.id_group ';
//
//$array_json = [];
//try {
//    $dbh = new PDO('pgsql:host=localhost; dbname=postgres', "postgres", "root", [
//        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//    ]);
//    $array_json = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
//
//    header("Content-Type: application\json");
//    echo json_encode(['success' => true, 'rows' => $array_json]);
//
//} catch (PDOException $e) {
//    echo "error: " . $e->getMessage() . "<br/>";
//    die();
//}




