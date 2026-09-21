<?php

require_once __DIR__ . "/../database/connection.php";

function validate()
{

    foreach ($_POST as $field => $value) {
        validateRequired($field, $value);

        if ($field == "email") {
            validateEmail($field, $value);
            validateUnique($field, $value, 'students');
        } else if ($field == "phone") {
            validatePhone($field, $value);
            validateUnique($field, $value, 'students');
        } else if ($field == "age") {
            validateAge($field, $value);
        } else if ($field == "firstName" || $field == "lastName") {
            validateName($field, $value);
        }
    }

    if (!empty($_SESSION['errors'])) {
        back();
    }
}


function EditValidate()
{

    foreach ($_POST as $field => $value) {
        if ($field != "password") {
            validateRequired($field, $value);
        }

        if ($field == "email") {
            validateEmail($field, $value);
            validateUnique($field, $value, 'students', $_POST['student_id']);
        } else if ($field == "phone") {
            validatePhone($field, $value);
            validateUnique($field, $value, 'students', $_POST['student_id']);
        }
    }

    if (!empty($_SESSION['errors'])) {
        back();
    }
}

function validateRequired(string $field, string $value)
{
    if ($value === null || trim((string)$value) === "") {
        addError($field, "{$field} is required");
    }
}

function addError(string $field, string $msg)
{
    $_SESSION['errors'][$field][] = $msg;
}

function validateEmail(string $field, string $value)
{
    if (empty($value)) {
        return;
    }

    $regex = "/^[A-Za-z_][A-Za-z_0-9\.\-]+@(gmail|yahoo)\.(com|org)$/";

    if (!preg_match($regex, $value)) {
        addError($field, "{$field} must be valid email");
    }
}

function validatePhone(string $field, string $value)
{
    if (empty($value)) {
        return;
    }

    $regex = "/^(02)?01(0|1|2|5)[0-9]{8}$/";

    if (!preg_match($regex, $value)) {
        addError($field, "{$field} must be Egyptian Phone");
    }
}


function validateAge(string $field, string $value)
{
    if (empty($value)) {
        return;
    }

    if ($value < 10) {
        addError($field, "{$field} must be +10");
    }
}


function validateUnique(string $field, string $value, string $table_name, ?int $exceptId = null)
{
    if (empty($value)) {
        return;
    }

    $DB = connection();

    $subQuery = "";

    if ($exceptId !== null) {
        $subQuery = "AND id != '{$exceptId}'";
    }

    $stmt = $DB->query("SELECT * FROM {$table_name}
    WHERE {$field} = '{$value}' 
    {$subQuery}
    ;");

    $result = $stmt->fetchAll();

    if (!empty($result)) {
        addError($field, "{$field} already Exists");
    }
}

function validateName(string $field, string $value)
{
    if (empty($value)) {
        return;
    }

    $regex = "/^[A-Za-z]{2,}$/";

    if (!preg_match($regex, $value)) {
        addError($field, "{$field} must be only letters (2 at least)");
    }
}
