<?php
use App\Entity\TitleEntity;
require_once "bootstrap.php";

// register_shutdown_function(function(){
//     var_dump(error_get_last());
//     die;
// });

    $benefitController = "\App\Controller\\" . $_GET["act"] . "Controller";
    $method = new $benefitController();
    $method-> {$_GET["method"]}($_REQUEST);





