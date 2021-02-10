<?php

require '../database.php';

$id = $_POST["id"];
$receipt_id = $_POST["receipt_id"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$address = $_POST["address"];

$id = ($new_id = write("INSERT INTO customers
VALUES ('$id', '$name', '$phone', '$address')
ON DUPLICATE KEY UPDATE phone='$phone', address='$address'")) ? $new_id : $id;

write("UPDATE receipt SET customer_id = '$id' WHERE receipt_id='$receipt_id'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <title>Document</title>
</head>

<body>
    <a href="../index.php">back to homepage</a>
</body>

</html>