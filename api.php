<?php

//register_shutdown_function(function (){
//    var_dump(error_get_last());
//    die();
//});

use App\Constants\Constants;

require_once "bootstrap.php";

    $controller = "\App\Controller\\" . $_GET["act"] . "Controller";
    $method = new $controller();
    $response = $method->{$_GET["method"]}($_REQUEST);
    if ($response != null) {
        outputJson(true, $response, Constants::HTTP_OK);
    }




//try {
//    $benefitController = "\App\Controller\\" . $_GET["act"] . "Controller";
//    $method = new $benefitController();
//    var_dump($method->{$_GET["method"]}($_REQUEST));
//    $response = $method->{$_GET["method"]}($_REQUEST);
//    if ($response != null) {
//        outputJson(true, $response, Constants::HTTP_OK);
//    }
//} catch (Exception $e) {
//    outputJson(false, $e->getMessage(), $e->getCode());
//} catch (Error $e) {
//    outputJson(false, 'Bad request', Constants::HTTP_BAD_REQUEST);
//}



// TODO
//  0. Добавить чекбоксы + Даты действия
//  1. Написать комментарии к коду в Controller, DTO
//  2. Вынести DropListC в отдельные  Controller
//  3. Поресерчим библиотеки по созданию пдф документов и выберем подходящую для нас (таблица в ТЗ)
//  3.1. TWIG + что-то конвертирующее html в pdf
//  4. Активные в конкретную дату
//  5. Пофиксить даты = null
