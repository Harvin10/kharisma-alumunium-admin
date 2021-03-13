<?php
require '../database.php';

$id = $_POST['id'];
$name = $_POST['name'];
$role = $_POST['role'];
$salary = $_POST['salary'];
$payment_time = $_POST['payment_time'];

if ($id == "-1") {
    $error = write("INSERT INTO employees VALUES ('', '$name', '$role', '$salary', '$payment_time')");
} else {
    $error = write("UPDATE employees SET role = '$role', payment_time = '$payment_time', salary = '$salary'");
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