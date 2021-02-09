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
    <section class="body">
        <section class="body-side">
            <section class="raw">
                <h2>raw</h2>
                <?php foreach ($raw_stocks as $key => $raw_stock) : ?>
                    <div class="card" onclick="newRawItem(
                    `<?= $raw_stock['id'] ?>`, 
                    `<?= $raw_stock['name'] ?>`, 
                    `<?= $raw_stock['color'] ?>`, 
                    `<?= $raw_stock['qty'] ?>`, 
                    `<?= $raw_stock['price'] ?>`), 
                    `<?= $key ?>`)">

                        <p class="unit"><?= $raw_stock['name'] ?></p>
                    </div>
                <?php endforeach; ?>
            </section>
            <section class="unit_stock">
                <h2>unit stock</h2>
                <?php foreach ($unit_stocks as $key => $unit_stock) : ?>
                    <div class="card" onclick="newStockUnit(
                    `<?= $unit_stock['id'] ?>`, 
                    `<?= $unit_stock['name'] ?>`, 
                    `<?= $unit_stock['unit_explanation'] ?>`, 
                    `<?= $unit_stock['price'] ?>`, 
                    `<?= $key ?>`)">

                        <p class="unit"><?= $unit_stock['name'] ?></p>
                    </div>
                <?php endforeach; ?>
            </section>
        </section>
        <section class="body-main">
            <form action="receipt.php" method="POST">
                <div class="inputs">
                </div>
                <button type="submit" name="submit">submit</button>
            </form>
        </section>
    </section>
</body>

</html>