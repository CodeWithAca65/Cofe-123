<?php

// povezivanje sa bazom podataka
$conn = mysqli_connect("localhost", "root", "", "kafic_123");

// provera konekcije
if (!$conn) {
    die("Neuspelo povezivanje sa bazom podataka: " . mysqli_connect_error());
}

// dobavljanje vrednosti iz forme
$product_name = $_POST['ime_proizvoda'];
$category_name = $_POST['kategorija_proizvoda'];
$price = $_POST['cena_proizvoda'];
$qty = $_POST['kolicina_proizvoda'];

// provera da li postoji kategorija u bazi podataka
$sql = "SELECT * FROM category WHERE name='$category_name'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    // kategorija ne postoji, prikazuje se greška
    echo "<div style='text-align: center;'><p>Kategorija ne postoji u bazi.</div>";
} else {
    // kategorija postoji, dodavanje proizvoda u bazu podataka
    $sql = "INSERT INTO product (name, category_name, price, qty) VALUES ('$product_name', '$category_name', '$price', '$qty')";

    if (mysqli_query($conn, $sql)) {
        // proizvod je uspešno dodat u bazu podataka
        echo "<div style='text-align: center;'><p>Proizvod dodat.</div>";
    } else {
        // greška prilikom dodavanja proizvoda u bazu podataka
        echo "Greška prilikom dodavanja proizvoda u bazu podataka: " . mysqli_error($conn);
    }
}

echo "<div style='text-align: center;'><a style='padding: 7px; text-decoration:none; border:1px solid black; border-radius:5px;' href='admin.php'>NAZAD</a></div>";

// zatvaranje konekcije sa bazom podataka
mysqli_close($conn);

?>