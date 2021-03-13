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
                <input type="text" name="search" onkeyup="getEmployee(this.value)">
            </label>
            <h2>supplier</h2>
            <section class="employee">

            </section>
        </section>
        <section class="body-main">
            <form action="employees_process.php" method="POST">
                <div class="inputs">
                    <input type="text" name="id" class="employees_data hidden">
                    <label>
                        name
                        <input type="text" name="name" class="employees_data" required onchange="changeID()">
                    </label>
                    <label>
                        role
                        <input type="text" name="role" class="employees_data" required>
                    </label>
                    <label>
                        salary
                        <input type="number" name="salary" class="employees_data" required>
                    </label>
                    <label>
                        payment_time
                        <input type="date" name="payment_time" class="employees_data" required>
                    </label>
                </div>
                <div class="button">
                    <button type="submit" name="submit">submit</button>
                </div>
            </form>
        </section>
    </section>
    <script>
        var cards = document.querySelector(".employee");
        var employees_data = document.querySelectorAll(".employees_data");

        var employeeData = (id, name, role, salary, payment_time) => {
            employees_data[0].value = id;
            employees_data[1].value = name;
            employees_data[2].value = role;
            employees_data[3].value = salary;
            employees_data[4].value = payment_time;
        }

        var changeID = () => {
            var id = document.querySelectorAll(".employees_data");
            id[0].value = "-1";
        }

        function getEmployee(id) {
            xhttp = new XMLHttpRequest();
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
                            <div class="card" onclick="employeeData(
                            '${data.id}', 
                            '${data.name}', 
                            '${data.role}',
                            '${data.salary}',
                            '${data.payment_time}')">

                                <p class="unit">${name}</p>
                            </div>
                        `;
                            let ul = document.createElement("ul");
                            ul.innerHTML = jsx;
                            cards.appendChild(ul);
                        })
                    }
                }
            };
            xhttp.open("GET", "../production/data/employee.php?q=" + id, true);
            xhttp.send();
        }
    </script>
</body>

</html>