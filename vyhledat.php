<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vyhledat knihu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <nav>
        <ul>
            <li><a href="vlozit.php">Vložit knihu</a></li>
            <li><a href="prehled.php">Seznam knih</a></li>
            <li><a href="vyhledat.php">Vyhledat knihu</a></li>
        </ul>
    </nav>
</div>

<h1>Vyhledávání knih</h1>
<form method="POST">
    Příjmení autora: <input type="text" name="autor_prijmeni" maxlength="50"><br>
    Křestní jméno autora: <input type="text" name="autor_jmeno" maxlength="50"><br>
    Název knihy: <input type="text" name="nazev" maxlength="50"><br>
    ISBN: <input type="text" name="isbn" maxlength="20"><br>
    <input type="submit" value="Vyhledat">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("dbLogin.php");
    if (!($con = mysqli_connect($host, $user, $password, $db))) {
        die("Nelze se připojit k db serveru</body></html>");
    }
    mysqli_query($con, "SET NAMES 'utf8'");

    $sql = "SELECT * FROM knihy WHERE 1=1";
    if (!empty($_POST['autor_prijmeni'])) {
        $sql .= " AND autor_prijmeni = '" . addslashes($_POST['autor_prijmeni']) . "'";
    }
    if (!empty($_POST['autor_jmeno'])) {
        $sql .= " AND autor_jmeno = '" . addslashes($_POST['autor_jmeno']) . "'";
    }
    if (!empty($_POST['nazev'])) {
        $sql .= " AND nazev = '" . addslashes($_POST['nazev']) . "'";
    }
    if (!empty($_POST['isbn'])) {
        $sql .= " AND isbn = '" . addslashes($_POST['isbn']) . "'";
    }

    $vysledek = mysqli_query($con, $sql);
    if (!$vysledek) {
        echo "Nelze provést dotaz: " . mysqli_error($con);
    } else {
        while ($radek = mysqli_fetch_array($vysledek)) {
            echo "<h2>" . $radek['nazev'] . "</h2>";
            echo "<p>Autor: " . $radek['autor_jmeno'] . " " . $radek['autor_prijmeni'] . "<br>";
            echo "ISBN: " . $radek['isbn'] . "<br>";
            echo "Popis: " . $radek['popis'] . "</p>";
        }
        if(mysqli_num_rows($vysledek) == 0) {
            echo "Nebyly nalezeny žádné knihy odpovídající zadaným kritériím.";
        }
        mysqli_free_result($vysledek);
    }
    mysqli_close($con);
}
?>
</body>
</html>