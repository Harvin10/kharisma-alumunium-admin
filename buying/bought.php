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
    <link rel="stylesheet" href="../style/bought.css">
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
                <li><a href="../selling/sold.php">sales</a></li>
                <li><a href="../buying/bought.php" class="this">purchases</a></li>
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
                <input type="text" name="search" onkeyup="getSupplier(this.value)">
            </label>
            <h2>supplier</h2>
            <section class="supplier">

            </section>
        </section>
        <section class="body-main">
            <form action="invoice.php" method="POST">
                <div class="inputs">
                    <input type="text" name="id" class="supplier_data hidden">
                    <label>
                        name
                        <input type="text" name="name" class="supplier_data" required>
                    </label>
                    <label>
                        phone
                        <input type="text" name="phone" class="supplier_data" required>
                    </label>
                    <label>
                        address
                        <input type="text" name="address" class="supplier_data" required>
                    </label>
                </div>
                <div class="button">
                    <button type="submit" name="submit">submit</button>
                </div>
            </form>
        </section>
    </section>
    <script>
        var cards_supplier = document.querySelector(".supplier");
        var supplier_data = document.querySelectorAll(".supplier_data");

        var supplierData = (id, name, phone, address) => {
            supplier_data[0].value = id;
            supplier_data[1].value = name;
            supplier_data[2].value = phone;
            supplier_data[3].value = address;
        }

        function getSupplier(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    cards_supplier.innerHTML = "";
                    let datas = JSON.parse(this.responseText);
                    let jsx;
                    let ul = document.createElement("ul");
                    if (typeof datas[0] == 'string') {
                        jsx = `${datas[0]}`;
                        ul.innerHTML = jsx;
                        cards_supplier.appendChild(ul);
                        // search.classList.remove("change-search");
                        // div.classList.remove("data-container-show");
                    } else {
                        datas.map((data, key) => {
                            let name = data.name;
                            let searchId = id;
                            let regex = new RegExp(searchId, "g");
                            name = name.replace(regex, `<span class="highlight">${searchId}</span>`)
                            jsx = ` 
                            <div class="card" onclick="supplierData(
                            '${data.id}', 
                            '${data.name}', 
                            '${data.phone}', 
                            '${data.address}')">

                                <p class="unit">${name}</p>
                            </div>
                        `;
                            let ul = document.createElement("ul");
                            ul.innerHTML = jsx;
                            cards_supplier.appendChild(ul);
                            // search.classList.add("change-search");
                            // div.classList.add("data-container-show");
                        })
                    }
                }
            };
            xhttp.open("GET", "data/supplier.php?q=" + id, true);
            xhttp.send();
        }
    </script>
</body>

</html>