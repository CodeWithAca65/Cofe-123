<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava admina</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            max-width: 300px;
            margin: 0 auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
        }

        form h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            display: block;
            width: 90%;
            height: 40px;
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            display: inline-block;
            background-color: burlywood;
            color: #fff;
            border-radius: 5px;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: linear-gradient(to bottom right, #EEC05D, #F9E3AF);
        }

        .centar {
            text-align: center;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <form method="post" action="logovanje.php">
        <h2>Logovanje admina</h2>
        <div class="form-group">
            <label for="broj_admina">Korisnicko ime admina:</label>
            <input type="text" class="form-control" id="ime_admina" name="ime_admina" required>
        </div>
        <div class="form-group">
            <label for="sifra_admina">Šifra admina:</label>
            <input type="password" class="form-control" id="sifra_admina" name="sifra_admina" required>
        </div>
        <button type="submit" class="btn btn-primary">Prijavi se</button><br><br>
        <button><a href="index.html">NAZAD</a></button>
        <p id="poruka" style="display: none;">Pogrešno korisničko ime ili lozinka.</p>
    </form>
</body>

</html>

<?php
session_start();

if (isset($_POST['ime_admina']) && isset($_POST['sifra_admina'])) {

    $ime_admina = $_POST['ime_admina'];
    $sifra_admina = $_POST['sifra_admina'];

    // Spajanje na bazu podataka
    $conn = mysqli_connect("localhost", "root", "", "kafic_123");

    if (!$conn) {
        die("Konekcija odbijena: " . mysqli_connect_error());
    }

    // Provera korisničkih podataka u bazi
    $sql = "SELECT * FROM `admin` WHERE username='$ime_admina' AND password='$sifra_admina'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Postavljanje sesije ako su korisnički podaci ispravni
        $_SESSION['ime_admina'] = $ime_admina;
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>document.getElementById('poruka').style.display = 'block';</script>";
    }

    mysqli_close($conn);
}
?>