<?php
require '../database.php';

/* sold.php page */

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
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/sold.css">
    <link rel="stylesheet" href="../style/receipt.css">
    <link rel="stylesheet" href="../style/header.css">
    <title>Document</title>
</head>

<body>
    <section class="header">
        <div class="logo">
            <a href="index.php"><img src="#" alt="Logo"></a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="../index.php">home</a></li>
                <li><a href="../selling/sold.php" class="this">sales</a></li>
                <li><a href="../buying/bought.php">purchases</a></li>
                <li><a href="../production/used.php">used items</a></li>
            </ul>
        </div>
        <div class="profile">
            <a href="#"></a> <!-- profile -->
        </div>
    </section>
    <section class="body">
        <section class="body-side">
            <label>
                search
                <input type="text" name="search" onkeyup="getCustomer(this.value)">
            </label>
            <h2>customers</h2>
            <section class="customer">

            </section>
        </section>
        <section class="body-main">
            <form action="print.php" method="POST">
                <div class="inputs">
                    <input type="text" name="id" class="customer_data hidden">
                    <input type="text" name="receipt_id" class="hidden" value="<?= $receipt_id ?>">
                    <label>
                        name
                        <input type="text" name="name" class="customer_data" onkeyup="removeId()" required>
                    </label>
                    <label>
                        phone
                        <input type="text" name="phone" class="customer_data" required>
                    </label>
                    <label>
                        address
                        <input type="text" name="address" class="customer_data" required>
                    </label>
                </div>
                <div class="button">
                    <button type="submit" name="submit">submit</button>
                </div>
            </form>
        </section>
    </section>
    <script>
        var cards_customer = document.querySelector(".customer");
        var customer_data = document.querySelectorAll(".customer_data");

        var customerData = (id, name, phone, address) => {
            customer_data[0].value = id;
            customer_data[1].value = name;
            customer_data[2].value = phone;
            customer_data[3].value = address;
        }

        var removeId = () => {
            customer_data[0].value = '';
        }

        function getCustomer(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    cards_customer.innerHTML = "";
                    let datas = JSON.parse(this.responseText);
                    let jsx;
                    let ul = document.createElement("ul");
                    if (typeof datas[0] == 'string') {
                        jsx = `${datas[0]}`;
                        ul.innerHTML = jsx;
                        cards_customer.appendChild(ul);
                        // search.classList.remove("change-search");
                        // div.classList.remove("data-container-show");
                    } else {
                        datas.map((data, key) => {
                            let name = data.name;
                            let searchId = id;
                            let regex = new RegExp(searchId, "g");
                            name = name.replace(regex, `<span class="highlight">${searchId}</span>`)
                            jsx = ` 
                            <div class="card" onclick="customerData(
                            '${data.id}', 
                            '${data.name}', 
                            '${data.phone}', 
                            '${data.address}')">

                                <p class="unit">${name}</p>
                            </div>
                        `;
                            let ul = document.createElement("ul");
                            ul.innerHTML = jsx;
                            cards_customer.appendChild(ul);
                            // search.classList.add("change-search");
                            // div.classList.add("data-container-show");
                        })
                    }
                }
            };
            xhttp.open("GET", "data/customer.php?q=" + id, true);
            xhttp.send();
        }
    </script>
</body>

</html>