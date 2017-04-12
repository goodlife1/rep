<?php

$root_path = str_replace("\\", "/", dirname(__file__));
define("ROOT", $root_path);
require(ROOT.'/vendor/autoload.php');
require_once ROOT . "/controllers/Controller.php";
require_once ROOT."/vendor/app.php";
require_once ROOT."/vendor/db/Database.php";

if($_SERVER['REQUEST_URI']!= '/'){
    $request = $_SERVER['REQUEST_URI'];}
    else{
    $request = 'book';
}
new App(substr($request,1));


?>