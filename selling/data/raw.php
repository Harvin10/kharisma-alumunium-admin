<?php

require '../../database.php';
$q = $_REQUEST["q"];
$value = [];

$datas = $conn->query("SELECT raw_stock.id, raw_stock.name, raw_stock.color, raw_in.qty, raw_in.price FROM raw_stock LEFT JOIN raw_in ON raw_stock.id = raw_in.raw_id WHERE raw_stock.name LIKE '%$q%' or raw_stock.color LIKE '%$q%'");

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
