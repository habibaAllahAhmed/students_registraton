<?php

function connection(): PDO
{

    $DSN = "mysql:host=localhost;dbname=register";
    $UserName = "root";
    $Password = "";

    try {
        $DB = new PDO($DSN, $UserName, $Password);
        $DB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Database connection failed : {$e->getMessage()}";
        exit;
    }

    return $DB;
}
