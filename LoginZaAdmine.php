<?php

    session_start();

    if( isset($_POST['username']) && $_POST['username'] == 'student' &&
        isset($_POST['password']) && $_POST['password'] == 'phpakademija'
    ) {
        $_SESSION['is_logged_in'] = true;
    }

?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Login example</title>
    <style>
        input, textarea { display: block; }
    </style>
</head>
<body>
    <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>

   
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
        echo '<table width="1000" border="1px" cellpadding="2" cellspacing="2">';
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
        <h2> Pritisnite logout za izlazak</h2>
          <?php if($_GET['logout']==1) session_destroy(); ?>
        <a href="?logout=1">Logout</a>
        

    <?php else: ?>
        
 <header>
    <ul>
         <li><a href="index.php">Naslovnica</a></li>
            <li><a href="Prijavnica.php">Prijavi se</a></li>
        <li><a href="LoginZaAdmine.php">Login(za admine)</a></li>
    </ul>
</header>
        <form method="post">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required />

            <label for="password">Password</label>
            <input type="text" id="password" name="password" required />

            <button type="submit">Login</button>

        </form>

    <?php endif ?>

</body>
</html>

