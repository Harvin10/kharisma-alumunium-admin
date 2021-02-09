<?php

require '../database.php';
$q = $_REQUEST["q"];
$value = [];

$datas = $conn->query("SELECT * FROM raw_stock WHERE name LIKE '%$q%'");

foreach ($datas as $data) {
    $person = [];
    $person["id"] = $data["id"];
    $person["name"] = $data["name"];
    $person["color"] = $data["color"];
    $person["qty"] = $data["qty"];
    $person["price"] = $data["price"];
    array_push($value, $person);
}

if (count($value) == 0) {
    array_push($value, "not found");
}

echo json_encode($value);
