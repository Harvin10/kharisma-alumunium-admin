<?php

require '../../database.php';
$q = $_REQUEST["q"];
$value = [];

$datas = $conn->query("SELECT * FROM employees WHERE name LIKE '%$q%'");

foreach ($datas as $data) {
    $person = [];
    $person["id"] = $data["id"];
    $person["name"] = $data["name"];
    $person["role"] = $data["role"];
    $person["salary"] = $data["salary"];
    $person["payment_time"] = $data["payment_time"];
    array_push($value, $person);
}

if (count($value) == 0) {
    array_push($value, "not found");
}

echo json_encode($value);
