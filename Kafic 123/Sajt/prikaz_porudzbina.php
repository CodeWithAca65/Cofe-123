<?php
// Povezivanje na bazu podataka
$conn = mysqli_connect("localhost", "root", "", "kafic_123");

// Provera konekcije
if (!$conn) {
    die("Konekcija nije uspela: " . mysqli_connect_error());
}

// Izvršavanje upita za dobavljanje porudžbina
$sql = "SELECT * FROM `order`";
$result = mysqli_query($conn, $sql);

// Prikazivanje porudžbina u tabeli
if (mysqli_num_rows($result) > 0) {
    echo "<div id='my-div'><table border='1' id='my-table'>";
    echo "<tr><th>ID</th><th>Porucilac</th><th>Proizvod</th><th>Kolicina</th><th>Iznos</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["customer"] . "</td><td>" . $row["product"] . "</td><td>" . $row["qty"] . "</td><td>" . $row["amount"] . "</td></tr>";
    }
    echo "</table></div>";
} else {
    echo "<div style='text-align: center;'><p>Nema porudžbina.</p></div>";
}

echo "<div style='text-align: center;'><a style='padding: 7px; text-decoration:none; border:1px solid black; border-radius:5px;' href='admin.php'>NAZAD</a></div>";

// Zatvaranje konekcije
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porudzbine</title>
    <style>
        #my-div {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
        }

        #my-table {
            margin: auto 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
        }
    </style>
</head>

<body>

</body>

</html>