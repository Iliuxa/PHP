<?php

// для отладки

// register_shutdown_function(function(){
//     var_dump(error_get_last());
//     die;
// });

// var_dump(); die;
// https://www.php.net/manual/en/pdo.connections.php
//x
$query = 'select t.full_name , t.short_name , c.category_name ,g.group_name 
from benefits b 
inner join title t ON b.id_title = t.id_title 
inner join category c ON b.id_category  = c.id_category
inner join group_ g ON b.id_group  = g.id_group ';

$array_json = [];
try {
    $dbh = new PDO('pgsql:host=localhost; dbname=postgres', "postgres", "root", [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    $array_json = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);

    header("Content-Type: application\json");
    echo json_encode(['success' => true, 'rows' => $array_json]);

} catch (PDOException $e) {
    echo "error: " . $e->getMessage() . "<br/>";
    die();
}






/*

$dbconn =  pg_connect("host=localhost dbname=postgres user=postgres password=root")
    or die('Не удалось соединиться: ' . pg_last_error());

$query_1 = 'select t.full_name , t.short_name , c.category_name ,g.group_name 
from benefits b ,category c ,group_ g ,title t
where b.id_title = t.id_title 
and  b.id_category = c.id_category 
and  b.id_group  = g.id_group ';

$query_2 = 'select count(id_category)  from  category c';

$result = pg_query($dbconn, $query_2) or die('Ошибка запроса: ' . pg_last_error());
$count = pg_fetch_array($result, null, PGSQL_NUM);

$result = pg_query($dbconn, $query_1) or die('Ошибка запроса: ' . pg_last_error());

for($i = 0; $i < $count[0]; $i++){
    $array_json[$i] = pg_fetch_array($result, $i, PGSQL_NUM);
}

header("Content-Type: application\json");
echo json_encode($array_json, JSON_FORCE_OBJECT);


pg_free_result($result);


pg_close($dbconn);*/

?>

