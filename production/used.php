<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/sold.css">
    <link rel="stylesheet" href="../style/invoice.css">
    <link rel="stylesheet" href="../style/used.css">
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
                <li><a href="../selling/sold.php">sales</a></li>
                <li><a href="../buying/bought.php">purchases</a></li>
                <li><a href="../production/used.php" class="this">used items</a></li>
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
                <input type="text" name="search_raw" onkeyup="getRaw(this.value)">
            </label>
            <label>
                employee
                <input type="text" name="search_employee" onkeyup="getEmployee(this.value)">
            </label>
            <h2 class="label">Raw Item</h2>
            <section class="cards">

            </section>
        </section>
        <section class="body-main">
            <form action="" method="POST" id="items">
                <div class="input_employee invoice">
                    <input type="text" name="employee_id" class="employee_data hidden">
                    <label>
                        name
                        <input type="text" name="name" class="employee_data" required>
                    </label>
                </div>
                <div class="inputs-container">
                    <div class="input_raw inputs">
                    </div>
                </div>
                <div class="button">
                    <div class="submit-ajax">submit</div>
                </div>
            </form>
        </section>
    </section>
    <script>
        var cards = document.querySelector(".cards");
        var label = document.querySelector(".label");
        var employee_data = document.querySelectorAll(".employee_data");
        var inputs = document.querySelector(".input_raw");
        var submit = document.querySelector(".submit-ajax");

        submit.addEventListener("click", inputData);

        var newRawItem = (id, name, color, price, key) => {
            let div = document.createElement("div");
            let jsx = `
                <input type="text" name="id[]" value="${id}" class="hidden">
                <label>
                    Name
                    <input type="text" name="item[]" value="${name}" readonly>
                </label>
                <label>
                    Price
                    <input type="text" name="color[]" value="${color}" readonly>
                </label>
                <label>
                    Quantity
                    <input type="number" name="used_qty[]">
                </label>
            `;
            div.innerHTML = jsx;
            inputs.appendChild(div);
        }

        var newEmployee = (id, name) => {
            employee_data[0].value = id;
            employee_data[1].value = name;
        }

        var xhttp = new XMLHttpRequest();

        function inputData() {
            var form = document.querySelector("#items");
            var formData = new FormData(form);
            if (employee_data[1].value == "") {
                alert("Please enter employee name");
                return
            } else if (inputs.innerText == "") {
                alert("Please enter items");
                return
            } else {
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        cards.innerHTML = "";
                        inputs.innerHTML = "";
                        newEmployee("", "");
                        alert("success");
                    }
                }
                xhttp.open("POST", "data/inputUsed.php", true);
                xhttp.send(formData);
            }
        }

        function getRaw(id) {
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    cards.innerHTML = "";
                    let datas = JSON.parse(this.responseText);
                    let jsx;
                    let ul = document.createElement("ul");
                    if (typeof datas[0] == 'string') {
                        jsx = `${datas[0]}`;
                        ul.innerHTML = jsx;
                        cards.appendChild(ul);
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
                            '${key}')">

                                <p class="unit">${name}</p>
                            </div>
                        `;
                            let ul = document.createElement("ul");
                            ul.innerHTML = jsx;
                            cards.appendChild(ul);
                            label.innerHTML = "Raw Item";
                        })
                    }
                }
            };
            xhttp.open("GET", "../selling/data/raw.php?q=" + id, true);
            xhttp.send();
        }

        function getEmployee(id) {
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    cards.innerHTML = "";
                    let datas = JSON.parse(this.responseText);
                    let jsx;
                    let ul = document.createElement("ul");
                    if (typeof datas[0] == 'string') {
                        jsx = `${datas[0]}`;
                        ul.innerHTML = jsx;
                        cards.appendChild(ul);
                    } else {
                        datas.map((data, key) => {
                            let name = data.name;
                            let searchId = id;
                            let regex = new RegExp(searchId, "g");
                            name = name.replace(regex, `<span class="highlight">${searchId}</span>`)
                            jsx = ` 
                            <div class="card" onclick="newEmployee(
                            '${data.id}', 
                            '${data.name}')">

                                <p class="unit">${name}</p>
                            </div>
                        `;
                            let ul = document.createElement("ul");
                            ul.innerHTML = jsx;
                            cards.appendChild(ul);
                            label.innerHTML = "Employee";
                        })
                    }
                }
            };
            xhttp.open("GET", "data/employee.php?q=" + id, true);
            xhttp.send();
        }
    </script>
</body>

</html>