<?php
require '../database.php';

if (isset($_POST["invoice_id"])) {
    $invoice_id = $_POST['invoice_id'];
    $date = date("Y-m-d H-i-s");
    $supplier_id = $_POST['supplier_id'];
    var_dump($supplier_id);
    $ids = $_POST['id'];

    // $error = write("INSERT INTO invoice VALUES ('$invoice_id', '$date', '$supplier_id', '')");
    // if (gettype($error) != 'integer') {
    //     header("Location: invoice.php");
    // }
    // var_dump(gettype($error));

    foreach ($ids as $key => $id) {
        $item_id = $_POST['id'][$key];
        $name = $_POST["item"][$key];
        $color = $_POST["color"][$key];
        $qty = $_POST['sold_qty'][$key];
        $price = $_POST['price'][$key];
        $item_id = ($new_id = write("INSERT INTO raw_stock VALUES ('$item_id', '$name', '$color') ON DUPLICATE KEY UPDATE name='$name', color='$color'")) ? $new_id : $id;
        write("INSERT INTO raw_in VALUES ('$invoice_id', '$id', '$qty', '$price')");
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