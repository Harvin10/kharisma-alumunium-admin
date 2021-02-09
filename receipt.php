<?php
require 'database.php';

$employee = 'harvin';

$x = read("SELECT id FROM employees WHERE name='$employee'");
$employee_id = $x[0]["id"];
$date = date("Y-m-d H-i-s");

$receipt_id = write("INSERT INTO receipt VALUES ('', '$date', '$employee_id', '1', '0', '0')");

$types = $_POST["item_type"];
$custom_cnt = 0;
foreach ($types as $key => $type) {
    $id = $_POST["id"][$key];
    $qty = $_POST["sold_qty"][$key];
    $price = $_POST["price"][$key];

    switch ($type) {
        case 0: {
                $item_id = write("INSERT INTO sold_item VALUES ('$receipt_id', '', '$type', '$qty', '$price')");
                write("INSERT INTO raw_stock_sold VALUES ('$item_id', '$type', '$id')");
                break;
            }
        case 1: {
                $item_id = write("INSERT INTO sold_item VALUES ('$receipt_id', '', '$type', '$qty', '$price')");
                write("INSERT INTO unit_stock_sold VALUES ('$item_id', '$type', '$id')");
                break;
            }
        case 2: {
                $name = $_POST["item"][$custom_cnt];
                $exp = $_POST["unit_explanation"][$custom_cnt];
                $custom_item_id = write("INSERT INTO unit_custom VALUES ('', '$name', '$exp')");
                $item_id = write("INSERT INTO sold_item VALUES ('$receipt_id', '', '$type', '$qty', '$price')");
                write("INSERT INTO unit_custom_sold VALUES ('$item_id', '$type', '$custom_item_id')");
                $custom_cnt++;
                break;
            }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>