<?php 

// Uspostavljamo konekciju sa bazom podataka
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kafic_123";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Greška prilikom konekcije: " . $conn->connect_error);
}

// Dohvatanje podataka iz tabele "product"
$sql = "SELECT `name`, `price`, `qty` FROM product ORDER BY category_name, qty";
$result = $conn->query($sql);

// Prikaz podataka u tabeli
if ($result->num_rows > 0) {
  echo "<br><div class='centar'><table border='1'>";
  echo "<tr><th>Proizvod</th><th>Cena</th><th>Dustupno</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["price"] . " RSD</td><td>" . $row["qty"] . "</tr>";
  }
  echo "</table></div>";
} else {
  echo "Nema dostupnih proizvoda.";
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porudzbina</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        form {
            margin: 0 auto;
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            background-color: #f2f2f2;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        a {
            text-decoration: none;
        }

        .centar {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
            text-align: center;
        }

        td, th {
            padding: 2px 8px;
        }
    </style>
</head>

<body>
    <h1>Porudzbina</h1>
    <form method="post" action="process_order.php">
        <label for="customer">Kupac:</label>
        <input type="text" name="customer" id="customer">
        <label for="product">Proizvod:</label>
        <input type="text" name="product" id="product">
        <label for="qty">Količina:</label>
        <input type="number" name="qty" id="qty">
        <input type="submit" name="posalji" value="Potvrdi porudžbinu"><br>
        <div class="centar"><a href="index.html">POCETNA</a></div>
    </form>
</body>

</html>