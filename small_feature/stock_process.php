<?php
require '../database.php';

$ids = $_POST["id"];
$item_type = $_POST["item_type"];

foreach ($ids as $key => $id) {
    $name = $_POST["item"][$key];
    $unit_explanation = $_POST["unit_explanation"][$key];
    $qty = $_POST["sold_qty"][$key];
    $price = $_POST["price"][$key];
    if ($item_type[$key] == "1") {
        $error = write("UPDATE unit_stock SET price = '$price', qty = qty + '$qty', unit_explanation = '$unit_explanation' WHERE id = '$id'");
    } else {
        $error = write("INSERT INTO unit_stock VALUES ('', '$name', '$unit_explanation', '$qty', '$price')");
    }

    var_dump($error);
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
    <a href="../index.php">back to homepage</a>
</body>

</html>