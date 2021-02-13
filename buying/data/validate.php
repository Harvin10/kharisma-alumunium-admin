<?php
require '../../database.php';

$invoice_id = $_POST['invoice_id'];

$available = read("SELECT invoice_id FROM invoice WHERE invoice_id = '$invoice_id'");

$response = ($available) ? "true" : "false";

echo $response;
