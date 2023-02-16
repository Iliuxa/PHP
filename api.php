<?php

use App\Constants\Constants;

require_once "bootstrap.php";

try {
   $benefitController = "\App\Controller\\" . $_GET["act"] . "Controller";
   $method = new $benefitController();
   $response = $method->{$_GET["method"]}($_REQUEST);
   if ($response != null) {
       outputJson(true, $response, Constants::HTTP_OK);
   }
} catch (Exception $e) {
   outputJson(false, $e->getMessage(), $e->getCode());
} catch (Error $e) {
   outputJson(false, 'Bad request', Constants::HTTP_BAD_REQUEST);
}
