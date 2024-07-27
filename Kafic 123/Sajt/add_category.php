<?php
// Povezivanje na bazu podataka
$conn = mysqli_connect("localhost", "root", "", "kafic_123");

// Provera konekcije
if (!$conn) {
  die("Konekcija nije uspela: " . mysqli_connect_error());
}

// Prihvatanje podataka iz forme
$ime_kategorije = $_POST['ime_kategorije'];

// SQL upit za dodavanje nove kategorije
$sql = "INSERT INTO category(`name`) VALUES ('$ime_kategorije')";

// Izvršavanje up
mysqli_query($conn, $sql);

echo "<div style='text-align: center;'><p>Kategorija dodata.</div>";
echo "<div style='text-align: center;'><a style='padding: 7px; text-decoration:none; border:1px solid black; border-radius:5px;' href='admin.php'>NAZAD</a></div>";