<?php

session_start();

require_once __DIR__ . "/helper.php";
require_once __DIR__ . "/validation.php";
require_once __DIR__ . "/../database/connection.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    throwErr(405, "Method not allowed");
}


$_SESSION['errors'] = [];
$_SESSION['_old'] = $_POST;

validate();

$DB = connection();

$hashPass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$DB->exec("INSERT INTO students 
(first_name, last_name , email , password , age , phone )
 VALUES 
('{$_POST['firstName']}' , '{$_POST['lastName']}' , '{$_POST['email']}', '{$hashPass}', '{$_POST['age']}','{$_POST['phone']}')");

unset($_SESSION['_old']);
back();
