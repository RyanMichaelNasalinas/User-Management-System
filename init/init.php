<?php 

//Autoload Classes
spl_autoload_register(function($className) {
    include_once './class/' . lcfirst($className) . '.php';
});


$database = new Database;
$action = new Action;
$validation = new Validation;
$login = new Login;
$user = new User;

?>