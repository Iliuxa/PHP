<html>
    <body>
        <form method="POST" action="input.php">
        <input type="text" name="full_name" placeholder="Enter full name"> <br>
        <input type="text" name="short_name" placeholder="Enter short name "> <br>
        <input type="text" name="category_name" placeholder="Enter category name"> <br>
        <input type="text" name="group_name" placeholder="Enter group name"> <br>
        <button type="submit" >Send</button><br>
    </body>
</html>

<?php
 $dbconn =  pg_connect("host=localhost dbname=postgres user=postgres password=root")
 or die('Не удалось соединиться: ' . pg_last_error());

$query = 'select count(id_benefits)  from benefits  ';
$result = pg_query($dbconn, $query) or die('Ошибка запроса: ' . pg_last_error());
$count_benefits = pg_fetch_array($result, null, PGSQL_NUM);
$count_benefits++;
$benefits = ["id_benefits" => $count_benefits, "id_title" => 0, "id_category" => 0, "id_group" => 0];

  $title = [ "full_name" => $_POST['full_name'], "short_name" => $_POST['short_name'] ];
  $query = 'select count(full_name)  from title';
  $result = pg_query($dbconn, $query) or die('Ошибка запроса: ' . pg_last_error());
  $count_str = pg_fetch_array($result, null, PGSQL_NUM);
  $query = 'select full_name from title';
  $result = pg_query($dbconn, $query) or die('Ошибка запроса: ' . pg_last_error());

  for ($i = 0; $i < $count_str; $i++){
      if($title["full_name"] == pg_fetch_array($result, $i, PGSQL_NUM)[0]){
          $benefits["id_title"] = $i + 1;
          goto a;
      }
  }
  $title_new = ["id_title" => $count_str +1];
  array_unshift($title, $title_new );
$title = [ "full_name" => $_POST['full_name'], "short_name" => $_POST['short_name'] ];
$query = 'INSERT INTO title ';
  $benefits["id_title"] = $count_str +1;
a:
echo "xxxxx";
$category = [ "category_name" => $_POST['category_name'] ];
$query = 'select count(category_name)  from category  ';
$result = pg_query($dbconn, $query) or die('Ошибка запроса: ' . pg_last_error());
$count_str = pg_fetch_array($result, null, PGSQL_NUM);
$query = 'select category_name from category';
$result = pg_query($dbconn, $query) or die('Ошибка запроса: ' . pg_last_error());
for ($i = 0; $i < $count_str; $i++){
    if($category["category_name"] == pg_fetch_array($result, $i, PGSQL_NUM)[0]){
        $benefits["id_category"] = $i + 1;
        goto b;
    }
}
$category_new = ["id_category" => $count_str +1];
array_unshift($category, $category_new );
$xx = pg_insert($dbconn, 'category', $category);
if ($xx) {
    echo "2\n";
} else {
    echo "0\n";
}
$benefits["id_category"] = $count_str +1;
b:

$group = [ "group_name" => $_POST['group_name'] ];
$query = 'select count(group_name)  from group_';
$result = pg_query($dbconn, $query) or die('Ошибка запроса: ' . pg_last_error());
$count_str = pg_fetch_array($result, null, PGSQL_NUM);
$query = 'select group_name from group';
$result = pg_query($dbconn, $query) or die('Ошибка запроса: ' . pg_last_error());
for ($i = 0; $i < $count_str; $i++){
    if($group["group_name"] == pg_fetch_array($result, $i, PGSQL_NUM)[0]){
        $benefits["id_group"] = $i + 1;
        goto c;
    }
}

$group_new = ["id_group" => $count_str +1];
array_unshift($group, $group_new );
$xx = pg_insert($dbconn, 'group_', $group);
if ($xx) {
    echo "3\n";
} else {
    echo "0\n";
}
$benefits["id_group"] = $count_str +1;
c:

$xx = pg_insert($dbconn, 'benefits', $benefits);
if ($xx) {
    echo "4\n";
} else {
    echo "0\n";
}
echo "хуй\n";
pg_free_result($result);
pg_close($dbconn);

function check_str (array $x){

}

?>