<?php

require_once __DIR__ . "/helper.php";
require_once __DIR__ . "/../database/connection.php";

header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    throwAPIErr(405, "method not allowed");
}

if (!isset($_POST['student_id'])) {
    throwAPIErr(422, "unprocessable entity");
}

$DB = connection();

$DB->exec("DELETE FROM students WHERE id = '{$_POST['student_id']}';");

echo json_encode([
    "status" => 200,
    "message" => "Student deleted successfully"
]);
