<?php
session_start();
if (!isset($_SESSION["ime_admina"]) || $_SESSION["ime_admina"] != true) {
    header("Location: logovanje.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        /* stilizovanje diva sa klasom "forme" */
        .forme {
            margin: 0 auto;
            padding: 20px;
            max-width: 550px;
            background-color: #fff;
            border: 1px solid black;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        /* stilizovanje naslova */
        h3 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* stilizovanje formi */
        form {
            width: 500px;
            margin: 20px auto;
        }

        /* stilizovanje form grupa */
        .form-group {
            margin-bottom: 20px;
        }

        /* stilizovanje labele */
        label {
            display: block;
            margin-bottom: 10px;
        }

        /* stilizovanje input polja */
        input[type="text"],
        input[type="number"],
        select {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        /* stilizovanje submit dugmeta */
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        /* stilizovanje odjave dugmeta */
        input[type="submit"] {
            background-color: #f44336;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        /* stilizovanje linka za povratak na početnu stranu */
        .center {
            text-align: center;
            margin-top: 20px;
        }

        .center a {
            font-size: 16px;
            color: #4CAF50;
            text-decoration: none;
            border-bottom: 1px solid #4CAF50;
            padding-bottom: 3px;
        }

        .center a:hover {
            color: #333;
            border-color: #333;
        }

        td, th {
            padding: 7px;
        }

        .form_c_btn {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="forme">
    <h3>Admin - prijavljen</h3>
    <hr>
    <!-- KATEGORIJA -->
    <form method="post" action="add_category.php">
        <h2>Unos nove kategorije</h2>
        <div class="form-group">
            <label for="ime_kategorije">Ime kategorije:</label>
            <input type="text" class="form-control" id="ime_kategorije" name="ime_kategorije" required>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj kategoriju</button>
    </form>
    <hr>
    <!-- PROIZVOD -->
    <form method="post" action="dodaj_proizvod.php">
        <h2>Unos novog proizvoda</h2>
        <div class="form-group">
            <label for="ime_proizvoda">Ime proizvoda:</label>
            <input type="text" class="form-control" id="ime_proizvoda" name="ime_proizvoda" required>
        </div>
        <div class="form-group">
            <label for="kategorija_proizvoda">Kategorija proizvoda:</label>
            <select class="form-control" id="kategorija_proizvoda" name="kategorija_proizvoda" required>
                <?php
                // Povezivanje na bazu podataka
                $conn = mysqli_connect("localhost", "root", "", "kafic_123");

                // Provera konekcije
                if (!$conn) {
                    die("Konekcija nije uspela: " . mysqli_connect_error());
                }
                // Učitavanje kategorija iz baze podataka
                $sql = "SELECT name FROM category";
                $result = mysqli_query($conn, $sql);

                // Prikazivanje opcija za select element
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="cena_proizvoda">Cena proizvoda:</label>
            <input type="number" class="form-control" id="cena_proizvoda" name="cena_proizvoda" min="0" required>
        </div>
        <div class="form-group">
            <label for="kolicina_proizvoda">Količina proizvoda:</label>
            <input type="number" class="form-control" id="kolicina_proizvoda" name="kolicina_proizvoda" min="0" required>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj proizvod</button>
    </form>
    <hr>
    <!-- IZMENA KOLICINE PROIZVODA -->
    <form action="izmena_kolicine.php" method="post">
        <h2>Izmena kolicine proizvoda</h2>
        <?php
                // Povezivanje na bazu podataka
                $conn = mysqli_connect("localhost", "root", "", "kafic_123");

                // Provera konekcije
                if (!$conn) {
                    die("Konekcija nije uspela: " . mysqli_connect_error());
                }
                // Dohvatanje podataka iz tabele "product"
                $sql = "SELECT `name`, `qty` FROM product ORDER BY category_name, qty";
                $result = $conn->query($sql);

                // Prikaz podataka u tabeli
                if ($result->num_rows > 0) {
                    echo "<br><div class='centar'><table border='1' style='border-collapse: collapse; margin: 0 auto; text-align: center;'>";
                    echo "<tr><th>Proizvod</th><th>Kolicina</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["qty"] . "</td></tr>";
                    }
                    echo "</table></div><br>";
                } else {
                    echo "<div style='text-align: center;'><p>Nema dostupnih proizvoda.</p></div><br>";
                }
                ?>
        <label for="qty">Unesi naziv proizvoda:</label>
        <input type="text" name="name" id="">
        <label for="qty">Unesi novu kolicinu proizvoda:</label>
        <input type="number" name="qty" id="">
        <button type="submit" class="btn btn-primary">Izmeni</button>
    </form>
    <hr>
    <!-- PRIKAZ PORUDZBINA -->
    <form action="prikaz_porudzbina.php" method="post" class="form_c_btn">
        <button type="submit" class="btn btn-primary">Prikazi porudzbine</button>
    </form>
    <hr>
    <!-- ODJAVA -->
    <form action="odjava.php" method="post" class="form_c_btn">
        <input type="submit" value="Odjavi me">
    </form>
    <hr>
    <!-- NAZAD NA POCETNU -->
    <div class="center">
        <a href="index.html">Pocetna</a>
    </div>
    </div>
</body>

</html>