<?php
require_once __DIR__ . "/helper.php";

session_start();

require_once __DIR__ . "/../database/connection.php";

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    throwAPIErr(405, "method not allowed");
}

if (!isset($_GET['student_id'])) {
    throwAPIErr(422, "unprocessable entity");
}

if (empty($_SESSION['errors'])) {
    $DB = connection();

    $stmt = $DB->query("SELECT 
id,
    first_name AS firstName,
    last_name AS lastName,
    email,
    age,
    phone
     FROM students WHERE id = '{$_GET['student_id']}'");

    $student = $stmt->fetch();
    if (empty($student)) {
        throwErr(422, "invalid id");
    }

    $_SESSION['_old'] = $student;
}
