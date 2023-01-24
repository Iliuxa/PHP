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

$requests = ['select * from title', 'select * from category', 'select * from group_'];
$requestsOut = ['insert into title values ( :id, :name, :fname)', 'insert into category values ( :id, :name)', 'insert into group_ values ( :id, :name)'] ;


$title = [ $_POST['full_name'],$_POST['short_name'] ];
$category = [ $_POST['category_name'] ];
$group = [ $_POST['group_name'] ];

$inp = [ $title, $category, $group];
$z = 1;
foreach ($inp as $x){
    if($x[0] == ''){
        $z = 0;
        echo "Заполните все поля!";
        break;
    }
}
if($z == 1) {
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
                if ($i == 0) { $query->bindParam(':fname', $title[1], PDO::PARAM_STR);}
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
        $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage() . "<br/>";
        die();
    }
}

?>