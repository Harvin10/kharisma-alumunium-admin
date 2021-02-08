<?php
require 'data.php';

$raw_stocks = read("SELECT * FROM raw_stock");
$unit_stocks = read("SELECT * FROM unit_stock");
// $unit_custom = read("SELECT * FROM unit_custom");

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
                <?php foreach ($raw_stocks as $raw_stock) : ?>
                    <div class="card" onclick="newRawItem(
                    `<?= $raw_stock['name'] ?>`, 
                    `<?= $raw_stock['color'] ?>`, 
                    `<?= $raw_stock['qty'] ?>`, 
                    `<?= $raw_stock['price'] ?>`)">

                        <p class="unit"><?= $raw_stock['name'] ?></p>
                    </div>
                <?php endforeach; ?>
            </section>
            <section class="unit_stock">
                <h2>unit stock</h2>
                <?php foreach ($unit_stocks as $unit_stock) : ?>
                    <div class="card" onclick="newStockUnit(
                    `<?= $unit_stock['name'] ?>`, 
                    `<?= $unit_stock['unit_explanation'] ?>`, 
                    `<?= $unit_stock['price'] ?>`)">

                        <p class="unit"><?= $unit_stock['name'] ?></p>
                    </div>
                <?php endforeach; ?>
            </section>
        </section>
        <section class="body-main">

        </section>
    </section>
    <script>
        var main = document.querySelector(".body-main");

        // var newCustomUnit = (unit, length, width, height, price) => {
        //     let div = document.createElement("div");
        //     let jsx = `
        //         <label>
        //             Unit
        //             <input type="text" name="unit" value="${unit}">
        //         </label>
        //         <label>
        //             Details
        //             <input type="text" name="details">
        //         </label>
        //         <label>
        //             Quantity
        //             <input type="number" name="qty">
        //         </label>
        //         <label>
        //             Length
        //             <input type="number" name="length" value="${length}">
        //         </label>
        //         <label>
        //             Width
        //             <input type="number" name="length" value="${width}">
        //         </label>
        //         <label>
        //             Height
        //             <input type="number" name="length" value="${height}">
        //         </label>
        //         <label>
        //             Price
        //             <input type="number" name="price" value="${price}">
        //         </label>
        //     `;
        //     div.innerHTML = jsx;
        //     main.appendChild(div);
        // }

        var newRawItem = (name, color, price) => {
            let div = document.createElement("div");
            let jsx = `
                <label>
                    <input type="text" name="item" value="${name}">
                </label>
                <label>
                    Price
                    <input type="text" name="color" value="${color}">
                </label>
                <label>
                    Quantity
                    <input type="number" name="sold_qty">
                </label>
                <label>
                    Price
                    <input type="number" name="price" value="${price * 2.5}">
                </label>
            `;
            div.innerHTML = jsx;
            main.appendChild(div);
        }

        var newStockUnit = (name, unit_explanation, price) => {
            let div = document.createElement("div");
            let jsx = `
                <label>
                    <input type="text" name="item" value="${name}">
                </label>
                <label>
                    unit explanation
                    <input type="text" name="unit_explanation" value="${unit_explanation}">
                </label>
                <label>
                    Quantity
                    <input type="number" name="sold_qty">
                </label>
                <label>
                    Price
                    <input type="number" name="price" value="${price}">
                </label>
            `;
            div.innerHTML = jsx;
            main.appendChild(div);
        }
    </script>
</body>

</html>