<?php
    // Povezivanje na bazu podataka
    $conn = mysqli_connect("localhost", "root", "", "kafic_123");

    // Provera konekcije
    if (!$conn) {
        die("Konekcija nije uspela: " . mysqli_connect_error());
    }

    // Provera da li je forma za dodavanje proizvoda poslata
    if (isset($_POST['posalji'])) {
        // uzimanje podataka iz forme
        $customer = $_POST["customer"];
        $product = $_POST["product"];
        $qty = $_POST["qty"];
        // Provera da li postoji proizvod sa datim imenom u bazi podataka
        $sql = "SELECT name FROM product WHERE name = '$product'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // dobijanje cene proizvoda iz baze
        $sql = "SELECT price FROM product WHERE name='$product'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $price = $row["price"];

        // računanje ukupnog iznosa
        $amount = $price * $qty;

        // Provjera da li ima dovoljno dostupne količine za porudžbinu
        $sql_kolicina = "SELECT * FROM product WHERE `name`='$product'";
        $result_kolicina = mysqli_query($conn, $sql_kolicina);
        $row_kolicina = mysqli_fetch_assoc($result_kolicina);
        $dostupna_kolicina = $row_kolicina["qty"];
        if ($qty > $dostupna_kolicina) {
          echo "<div style='text-align: center;'><p>Ovaj proizvod, za unetu kolicinu, nije dostupan na stanju.</p></div>";
        } else {
            // Dodavanje nove porudžbine u bazu podataka
            $sql = "INSERT INTO `order` (customer, product, qty, amount) VALUES ('$customer', '$product', '$qty', '$amount')";
            if (mysqli_query($conn, $sql)) {
                // Ažuriranje dostupne količine
                $nova_kolicina = $dostupna_kolicina - $qty;
                $sql_azuriranje = "UPDATE product SET qty = $nova_kolicina WHERE name = '$product'";
                mysqli_query($conn, $sql_azuriranje);
                echo "<div style='text-align: center;'><p>Porudžbina uspešno primljena! Njen iznos je: $amount RSD.</p></div>";
              } else {
                echo "Greška pri dodavanju porudžbine: " . mysqli_error($conn);
            }
        }
    }
    else {
      echo "<div style='text-align: center;'><p>Uneti proizvod nije pronadjen, proveri unos.</p></div>";
    }
  }
    echo "<div style='text-align: center;'><a style='padding: 7px; text-decoration:none; border:1px solid black; border-radius:5px;' href='porudzbina.php'>Nazad</a></div>";
?>