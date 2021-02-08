<?php
require 'data.php';

$id = ($id = read("SELECT receipt_id FROM receipt ORDER BY receipt_id DESC LIMIT 1")) ? $id : 0;
$raw_stocks = read("SELECT * FROM raw_stock");
$unit_stocks = read("SELECT * FROM unit_stock");
// $unit_custom = read("SELECT * FROM unit_custom");

if (isset($_POST["submit"])) {

    // $i = 0;
    // while (true) {
    //     $item = "item" . $i;
    //     $exp = "unit_explanation" . $i;
    //     $qty = "sold_qty" . $i;
    //     $price = "price" . $i;
    //     write("INSERT INTO sold_item VALUES ('$id', '$item')")
    //     $i++;
    // }
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
    <section class="header">
        <div class="logo">
            <a href="unitOut.php"><img src="#" alt="Logo"></a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="rawIn.php">Barang Datang</a></li> <!-- rawIn -->
                <li><a href="rawOut.php">Barang Dipakai</a></li> <!-- rawOut -->
                <li><a href="unitOut.php">Barang Dijual</a></li> <!-- unitOut -->
                <li><a href="stockDefault.php">Stock Unit Default</a></li>
            </ul>
        </div>
        <div class="profile">
            <a href="#"></a> <!-- profile -->
        </div>
    </section>
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
            <form action="" method="POST">
                <div class="inputs">
                </div>
                <button type="submit" name="submit">submit</button>
            </form>
        </section>
    </section>
    <script>
        var inputs = document.querySelector(".inputs");

        var newRawItem = (id, name, color, price, key) => {
            let div = document.createElement("div");
            let jsx = `
                <label>
                    <input type="text" name="item${key}" value="${name}">
                </label>
                <label>
                    Price
                    <input type="text" name="color${key}" value="${color}">
                </label>
                <label>
                    Quantity
                    <input type="number" name="sold_qty${key}">
                </label>
                <label>
                    Price
                    <input type="number" name="price${key}" value="${price * 2.5}">
                </label>
            `;
            div.innerHTML = jsx;
            inputs.appendChild(div);
        }

        var newStockUnit = (id, name, unit_explanation, price, key) => {
            let div = document.createElement("div");
            let jsx = `
                <label>
                    <input type="text" name="item${key}" value="${name}">
                </label>
                <label>
                    unit explanation
                    <input type="text" name="unit_explanation${key}" value="${unit_explanation}">
                </label>
                <label>
                    Quantity
                    <input type="number" name="sold_qty${key}">
                </label>
                <label>
                    Price
                    <input type="number" name="price${key}" value="${price}">
                </label>
            `;
            div.innerHTML = jsx;
            inputs.appendChild(div);
        }
    </script>
</body>

</html>