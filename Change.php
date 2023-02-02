<html>
<body>
<form method="POST" action="input.php">
    <input type="text" name="id" placeholder="Enter id"> <br>
    <input type="text" name="full_name" placeholder="Enter full name"> <br>
    <input type="text" name="short_name" placeholder="Enter short name "> <br>
    <input type="text" name="category_name" placeholder="Enter category name"> <br>
    <input type="text" name="group_name" placeholder="Enter group name"> <br>
<!--    <button type="submit" name="ButtonChange">Change</button><br>-->
    <form action="Change.php" method="POST">
        <input name="myActionName" type="submit" value="Выполнить" />
    </form>
</body>
</html>

<?php
if (isset($_POST['myActionName']) ){

    $id = [$_POST['id']];
    var_dump($id);
    $title = [$_POST['full_name'], $_POST['short_name']];
    $category = [$_POST['category_name']];
    $group = [$_POST['group_name']];

    $array_json = [];
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
}

?>
