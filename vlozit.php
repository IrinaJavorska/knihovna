<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vložit knihu</title>
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
<h1>Vkládání nových knih</h1>
<form method="POST">
    ISBN:
    <input type="text" name="isbn" required maxlength="20"><br>
    Křestní jméno autora:
    <input type="text" name="autor_jmeno" required maxlength="50"><br>
    Příjmení autora:
    <input type="text" name="autor_prijmeni" required maxlength="50"><br>
    Název knihy:
    <input type="text" name="nazev" required maxlength="50"><br>
    Popis:
    <textarea name="popis" required cols="30" rows="10"></textarea><br>
    <input type="submit" value="Vložit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("dbLogin.php"); 
    if (!($con = mysqli_connect($host,$user,$password, $db))){
        die("Nelze se připojit k db serveru</body></html>");
    } 
    mysqli_query($con,"SET NAMES 'utf8'");
    
    $query = sprintf("INSERT INTO knihy (isbn, autor_jmeno, autor_prijmeni, nazev, popis) VALUES ('%s', '%s', '%s', '%s', '%s')",
        addslashes($_POST['isbn']),
        addslashes($_POST['autor_jmeno']),
        addslashes($_POST['autor_prijmeni']),
        addslashes($_POST['nazev']),
        addslashes($_POST['popis'])
    );

    if (mysqli_query($con, $query)) {
        echo "Úspěšně vloženo";
    } else {
        echo "Nelze provést dotaz: " . mysqli_error($con);
    }
    mysqli_close($con);
}
?>
</body>
</html>
