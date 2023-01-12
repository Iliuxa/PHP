<?php

// для отладки

// register_shutdown_function(function(){
//     var_dump(error_get_last());
//     die;
// });

// var_dump(); die;  

$dbconn =  pg_connect("host=localhost dbname=postgres user=postgres password=root")
    or die('Не удалось соединиться: ' . pg_last_error());



$query = 'select t.full_name , t.short_name , c.category_name ,g.group_name 
from benefits b ,category c ,group_ g ,title t
where b.id_title = t.id_title 
and  b.id_category = c.id_category 
and  b.id_group  = g.id_group ';
$result = pg_query($dbconn, $query) or die('Ошибка запроса: ' . pg_last_error());

for($i = 0; $i < 2; $i++){
    $array_json[$i] = $array = pg_fetch_array($result, $i, PGSQL_NUM);
}



header("Content-Type: application\json");
echo json_encode($array_json, JSON_FORCE_OBJECT);


pg_free_result($result);


pg_close($dbconn);

?>

