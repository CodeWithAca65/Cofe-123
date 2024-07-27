<?php
// Povezivanje na bazu podataka
$conn = mysqli_connect("localhost", "root", "", "kafic_123");

// Provera konekcije
if (!$conn) {
    die("Konekcija nije uspela: " . mysqli_connect_error());
}

$product = $_POST['name'];
$quantity = $_POST['qty'];

// Provera da li postoji proizvod sa datim ID-om
$sql = "SELECT * FROM product WHERE `name`='$product'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Ažuriranje količine proizvoda u bazi podataka
    $sql = "UPDATE product SET qty='$quantity' WHERE `name`='$product'";
        if (mysqli_query($conn, $sql)) {
            echo "<div style='text-align: center;'><p>Kolicina je azurirana.</p></div>";
        } else {
            echo "Greška pri ažuriranju količine proizvoda: " . mysqli_error($conn);
        }
} else {
    echo "<div style='text-align: center;'><p>Uneti proizvod nije pronadjen, proveri unos.</p></div>";
}

echo "<div style='text-align: center;'><a style='padding: 7px; text-decoration:none; border:1px solid black; border-radius:5px;' href='admin.php'>Nazad</a></div>";

?>
