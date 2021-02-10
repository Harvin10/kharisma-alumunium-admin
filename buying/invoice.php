<?php

require '../database.php';

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    $id = ($new_id = write("INSERT INTO suppliers
    VALUES ('$id', '$name', '$phone', '$address')
    ON DUPLICATE KEY UPDATE phone='$phone', address='$address'")) ? $new_id : $id;
}

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
    <section class="header">
        <div class="logo">
            <a href="index.php"><img src="#" alt="Logo"></a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="../index.php">Barang Datang</a></li>
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
                <input type="text" name="search" onkeyup="getRaw(this.value)">
            </label>
            <h2>Raw Item</h2>
            <section class="raw">

            </section>
        </section>
        <section class="body-main">
            <form action="done.php" method="POST">
                <div class="invoice">
                    <input type="text" class="hidden" name="supplier_id" value="<?= $id ?>">
                    <label>
                        invoice number
                        <input type="text" name="invoice_id">
                    </label>
                </div>
                <div class="inputs">
                </div>
                <button type="submit" name="submit">submit</button>
            </form>
        </section>
    </section>
    <script>
        var cards_raw = document.querySelector(".raw");
        var inputs = document.querySelector(".inputs");
        var id = document.querySelector(".item_id")

        var removeId = () => {
            id.value = '';
        }

        var newRawItem = (id, name, color, price, key) => {
            let div = document.createElement("div");
            let jsx = `
                <input type="text" name="id[]" value="${id}" class="hidden item_id">
                <label>
                    name
                    <input type="text" name="item[]" value="${name}"  onkeyup="removeId()">
                </label>
                <label>
                    color
                    <input type="text" name="color[]" value="${color}">
                </label>
                <label>
                    Quantity
                    <input type="number" name="sold_qty[]">
                </label>
                <label>
                    Price
                    <input type="number" name="price[]" value="${price * 2.5}">
                </label>
            `;
            div.innerHTML = jsx;
            inputs.appendChild(div);
        }

        function getRaw(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    cards_raw.innerHTML = "";
                    let datas = JSON.parse(this.responseText);
                    let jsx;
                    let ul = document.createElement("ul");
                    if (typeof datas[0] == 'string') {
                        jsx = `${datas[0]}`;
                        ul.innerHTML = jsx;
                        cards_raw.appendChild(ul);
                        // search.classList.remove("change-search");
                        // div.classList.remove("data-container-show");
                    } else {
                        datas.map((data, key) => {
                            let name = data.name;
                            let searchId = id;
                            let regex = new RegExp(searchId, "g");
                            name = name.replace(regex, `<span class="highlight">${searchId}</span>`)
                            jsx = ` 
                            <div class="card" onclick="newRawItem(
                            '${data.id}', 
                            '${data.name}', 
                            '${data.color}', 
                            '${data.price}', 
                            '${key}')">

                                <p class="unit">${name}</p>
                            </div>
                        `;
                            let ul = document.createElement("ul");
                            ul.innerHTML = jsx;
                            cards_raw.appendChild(ul);
                            // search.classList.add("change-search");
                            // div.classList.add("data-container-show");
                        })
                    }
                }
            };
            xhttp.open("GET", "../selling/data/raw.php?q=" + id, true);
            xhttp.send();
        }
    </script>
</body>

</html>