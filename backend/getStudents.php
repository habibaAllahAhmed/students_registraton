<?php

function getStudent(string $search = "", int $page = 1)
{
    require_once __DIR__ . "/helper.php";
    require_once __DIR__ . "/../database/connection.php";

    $DB = connection();

    $offset = ($page * 10) - 10;


    $stmt = $DB->query("SELECT * FROM students WHERE
    first_name LIKE '%$search%'
    OR
    last_name LIKE '%$search%'
    OR
        CONCAT(first_name , ' ' , last_name ) LIKE '%$search%'
    OR
    email LIKE '%$search%'
    OR
    age LIKE '%$search%'
    OR
    phone LIKE '%$search%'
    LIMIT 10 OFFSET {$offset}
    ;");

    $data = $stmt->fetchAll();

    $stmt = $DB->query("SELECT COUNT(*) AS total FROM students WHERE
    first_name LIKE '%$search%'
    OR
    last_name LIKE '%$search%'
    OR
        CONCAT(first_name , ' ' , last_name ) LIKE '%$search%'
    OR
    email LIKE '%$search%'
    OR
    age LIKE '%$search%'
    OR
    phone LIKE '%$search%'
    ;");

    $total = $stmt->fetch()['total'];

    return [
        'data' => $data,
        'total' => $total,
        'currentPage' => $page
    ];
}


function getStudentsCount()
{
    $DB = connection();
    $stmt = $DB->query("SELECT COUNT(*) As total FROM students");

    $result = $stmt->fetch();

    return $result['total'];
}
