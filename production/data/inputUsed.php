<?php
require '../../database.php';

$ids = $_POST['id'];
$employee_id = $_POST['employee_id'];
$value;

foreach ($ids as $key => $id) {
    $qty = $_POST['used_qty'][$key];
    $date = date("Y-m-d");
    $value = write("INSERT INTO raw_used VALUES ('$date', '$id', '$employee_id', '$qty')");
}

echo json_encode($value);
