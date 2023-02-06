<?php

use App\Entity\TitleEntity;

require_once "bootstrap.php";

//register_shutdown_function(function () {
//    var_dump(error_get_last());
//    die;
//});

try {
    $benefitController = "\App\Controller\\" . $_GET["act"] . "Controller";
    $method = new $benefitController();
    $out = $method->{$_GET["method"]}($_REQUEST);
    if ($out != null) {
        outputJson(true, $out);
    }
} catch (Exception $e) {
    outputJson(false, $e->getMessage(),$e->getCode() );
}
catch (Error $e) {
    outputJson(false, 'Bad request' );
}
