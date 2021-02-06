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
            </ul>
        </div>
        <div class="profile">
            <a href="#"></a> <!-- profile -->
        </div>
    </section>
    <section class="body">
        <section class="body-header">
            <button onclick="newCustomUnit()">New Custom Unit</button>
            <button onclick="newStockUnit()">New Stock Unit</button>
            <button onclick="newRawItem()">New Raw Item</button>
        </section>
        <section class="body-main">

        </section>
    </section>
    <script>
        var main = document.querySelector(".body-main");

        var newCustomUnit = () => {
            let div = document.createElement("div");
            let jsx = `
                <label>
                    Unit
                    <select type="text" name="Unit">
                        <option value=""></option>
                    </select>
                </label>
                <label>
                    Details
                    <input type="text" name="details">
                </label>
                <label>
                    Quantity
                    <input type="number" name="qty">
                </label>
                <label>
                    Price
                    <input type="number" name="price">
                </label>
            `;
            div.innerHTML = jsx;
            main.appendChild(div);
        }

        var newStockUnit = () => {
            let div = document.createElement("div");
            let jsx = `
                <label>
                    Unit
                    <select type="text" name="Unit">
                        <option value=""></option>
                    </select>
                </label>
                <label>
                    Quantity
                    <input type="number" name="qty">
                </label>
                <label>
                    Price
                    <input type="number" name="price">
                </label>
            `;
            div.innerHTML = jsx;
            main.appendChild(div);
        }

        var newRawItem = () => {
            let div = document.createElement("div");
            let jsx = `
                <label>
                    Raw
                    <select type="text" name="Unit">
                        <option value=""></option>
                    </select>
                </label>
                <label>
                    Color
                    <select type="text" name="Unit">
                        <option value=""></option>
                    </select>
                </label>
                <label>
                    Quantity
                    <input type="number" name="qty">
                </label>
                <label>
                    Price
                    <input type="number" name="price">
                </label>
            `;
            div.innerHTML = jsx;
            main.appendChild(div);
        }
    </script>
</body>

</html>