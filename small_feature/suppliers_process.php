<?php
require "../database.php";

$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
if ($id == "-1") {
    $error = write("INSERT INTO suppliers VALUES ('', '$name', '$phone', '$address')");
} else {
    $error = write("UPDATE suppliers SET phone = '$phone', address = '$address' WHERE id = '$id' ");
}

var_dump($error);
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