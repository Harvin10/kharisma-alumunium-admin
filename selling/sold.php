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
                <input type="text" name="search" onkeyup="getRaw(this.value); getUnitStock(this.value)">
            </label>
            <h2>Raw Item</h2>
            <section class="raw">

            </section>
            <h2>Unit Stock</h2>
            <section class="unit_stock">

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
    <script>
        var cards_raw = document.querySelector(".raw");
        var cards_unit_stock = document.querySelector(".unit_stock");
        var inputs = document.querySelector(".inputs");

        var newRawItem = (id, name, color, price, key) => {
            let div = document.createElement("div");
            let jsx = `
                <input type="text" name="id[]" value="${id}" class="hidden">
                <input type="text" class="type${key}" name="item_type[]" value="0" class="hidden">
                <label>
                    <input type="text" name="item[]" value="${name}">
                </label>
                <label>
                    Price
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

        var newStockUnit = (id, name, unit_explanation, price, key) => {
            let div = document.createElement("div");
            let jsx = `
                <input type="text" name="id[]" value="${id}" class="hidden">
                <input type="text" class="type${key}" name="item_type[]" value="1" class="hidden">
                <label>
                    <input type="text" name="item[]" value="${name}">
                </label>
                <label>
                    unit explanation
                    <input type="text" name="unit_explanation[]" value="${unit_explanation}" onchange="changeItemType('type${key}')">
                </label>
                <label>
                    Quantity
                    <input type="number" name="sold_qty[]">
                </label>
                <label>
                    Price
                    <input type="number" name="price[]" value="${price}">
                </label>
            `;
            div.innerHTML = jsx;
            inputs.appendChild(div);
        }

        var changeItemType = (key) => {
            let type = document.querySelector("." + key).value = "2";
            console.log(type);
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
            xhttp.open("GET", "data/raw.php?q=" + id, true);
            xhttp.send();
        }

        function getUnitStock(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    cards_unit_stock.innerHTML = "";
                    let datas = JSON.parse(this.responseText);
                    let jsx;
                    let ul = document.createElement("ul");
                    if (typeof datas[0] == 'string') {
                        jsx = `${datas[0]}`;
                        ul.innerHTML = jsx;
                        cards_unit_stock.appendChild(ul);
                        // search.classList.remove("change-search");
                        // div.classList.remove("data-container-show");
                    } else {
                        datas.map((data, key) => {
                            let name = data.name;
                            let searchId = id;
                            let regex = new RegExp(searchId, "g");
                            name = name.replace(regex, `<span class="highlight">${searchId}</span>`);
                            jsx = ` 
                            <div class="card" onclick="newStockUnit(
                            '${data.id}', 
                            '${data.name}', 
                            '${data.unit_explanation}', 
                            '${data.price}', 
                            '${key}')">

                                <p class="unit">${name}</p>
                            </div>
                        `;
                            let ul = document.createElement("ul");
                            ul.innerHTML = jsx;
                            cards_unit_stock.appendChild(ul);
                            // search.classList.add("change-search");
                            // div.classList.add("data-container-show");
                        })
                    }
                }
            };
            xhttp.open("GET", "data/unit_stock.php?q=" + id, true);
            xhttp.send();
        }
    </script>
</body>

</html>