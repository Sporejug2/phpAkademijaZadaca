<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Evidencija prijavljenih</title>
    <style>
        input, textarea { display: block; }
    </style>
</head>
<body>

<header>
    <ul>
        <li><a href="index.php">Naslovnica</a></li>
        <li><a href="form.php">Prijavi se</a></li>
        <li>Login (za admine)</li>
    </ul>
</header>

    <h1> Evidencija studenata </h1>
    <?php
    include "spoj.php";
    
    $sql_upit="SELECT * FROM popis_studenata ORDER BY id ASC";
    if(!$q=mysql_query($sql_upit))
    {
    echo "Nismo uspjeli učitati studente iz baze"."<br>".mysql_query();
    die();
    }
    //ako je broj redaka nula onda nema studenata u bazi
    if(mysql_num_rows($q)==0)
    {
        echo"Nema studenata u bazi.";
    }
    else{
        echo '<table width="1000" border="1px" cellpadding="2" cellspacing="2" >';
        echo '<tr><td><b>id</b></td>';
        echo '<td><b>Ime</b></td>';
        echo '<td><b>prezime</b></td>';
        echo '<td><b>email_adresa</b></td>';
        echo '<td><b>smjer</b></td>';
        echo '<td><b>godina_studija</b></td>';
        echo '<td><b>motiv</b></td>';
        echo '<td><b>predznanje</b></td>';
        echo '<td><b>PhP</b></td>';
        echo '<td><b>MySql</b></td></tr>';
        
        //sve dok ima studenata u bazi
        while ($redak=mysql_fetch_array($q))
        {
            echo '<tr><td><b>'.$redak["id"].'</td>';
            echo '<td><b>'.$redak["ime"].'</b></td>';
            echo '<td><b>'.$redak["prezime"].'</b></td>';
            echo '<td><b>'.$redak["email_adresa"].'</b></td>';
            echo '<td><b>'.$redak["smjer"].'</b></td>';
            echo '<td><b>'.$redak["godina_studija"].'</b></td>';
            echo '<td><b>'.$redak["motiv"].'</b></td>';
            echo '<td><b>'.$redak["predznanje"].'</b></td>';
            echo '<td><b>'.$redak["PhP"].'</b></td>';
            echo '<td><b>'.$redak["MySql"].'</b></td></tr>';
        }
        echo '</table>';
        }
        ?>
   
</body>
</html>