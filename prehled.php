<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seznam knih</title>
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

    <h1>Přehled knih</h1>
    <?php 
        include("dbLogin.php"); 
        if (!($con = mysqli_connect($host,$user,$password,$db))){
            die("Nelze se připojit k db serveru</body></html>");
        } 
        mysqli_query($con,"SET NAMES 'utf8'");
        if(!($vysledek = mysqli_query($con, "SELECT isbn, autor_jmeno, autor_prijmeni, nazev, popis FROM knihy"))) {
            die("Nelze provést dotaz</body></html>");
        }
        while ($radek = mysqli_fetch_array($vysledek)) {
            ?>
                <h2><?php echo $radek["nazev"] ?></h2>
                <dl>
                    <dt>Autor:</dt>
                    <dd><?php echo $radek["autor_jmeno"] . " " . $radek["autor_prijmeni"] ?></dd>
                    <dt>ISBN:</dt>
                    <dd><?php echo $radek["isbn"] ?></dd>
                </dl>
                <p><?php echo $radek["popis"] ?></p>

            <?php
        }
        mysqli_free_result($vysledek);
        mysqli_close($con);
    ?>
</body>
</html>
