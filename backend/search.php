<?php

require_once __DIR__ . "/getStudents.php";
require_once __DIR__ . "/helper.php";

header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    throwAPIErr(405, "method not allowed");
}

if (!isset($_POST['search'])) {
    throwErr(422, "unprocessable entity");
}

$search = $_POST['search'];

$page = isset($_POST['page'])
    ? (int) $_POST['page']
    : 1;

$students = getStudent($search, $page);

echo json_encode($students);
