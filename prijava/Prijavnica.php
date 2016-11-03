<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        input, textarea { display: block; }
    </style>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
</head>
<body background="Back.jpg">

    <img src="inchoo.png">
<header>
    <ul>
         <li><a href="index.php">Naslovnica</a></li>
            <li><a href="Prijavnica.php">Prijavi se</a></li>
        <li><a href="LoginZaAdmine.php">Login(za admine)</a></li>
    </ul>
</header>

<main>

    <h1>Prijavnica za PHP akademiju</h1>
    <?php
    
    if(!$_POST["spremanje"])
    {
    ?>

    <p>Prijavnica za prvo osječko izdanje PHP akademije koju Inchoo pokreće u suradnji s FERITom.</p>
    <p>Prijave traju do <mark>10.10.</mark>, pa požuri i svoje mjesto rezerviraj već sad.</p>
    <p>Više informacija na:
        <a href="http://inchoo.hr/php-akademija-2016/" target="_blank">http://inchoo.hr/php-akademija-2016/</a>
    </p>

    <!-- fix form -->
    <form method="post" action=""> <!-- form -->
        <p> Ime : <input type="text" name="ime" class="form-control" required><br>
            Prezime : <input type="text" name="prezime" class="form-control" required><br>
        </p>
        
    
    <label>Mail adresa</label>
    <input type="email" name="email_adresa" class="form-control" required>

    <label>Smjer</label>
    <input type="text" name="smjer" class="form-control" required>

    <label>Godina studija</label><br>
    
    <select name="godina_studija" class="form-control">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select><br>
    
    

    <label>Što te motiviralo da se prijaviš?</label>
    <textarea name="motiv" class="form-control" rows="3" required></textarea><br>


    <label>Imaš li predznanje vezano uz web development?</label>
    <textarea name="predznanje" class="form-control" rows="3" required>

    </textarea><br>
    
    

    U kojim jezicima si do sada programirao?<br>
    Jesi li programirao PhP <br>
   <select name="PhP">
        <option>Da</option>
        <option>Ne</option>
   </select>
    
    <br>
    Jesi li programirao MySql<br>
    <select name="MySql">
        <option>Da</option>
        <option>Ne</option>
   </select>
    <br>
    <br>
    
    Uploadaj primjer svoga koda:<br>
    <input name="datoteka_za_upload" type="file"><br>
    Uploadaj primjer svoga koda:<br>
        
        
        <input type="submit"  name="spremanje" value="Spremi" class="btn btn-primary" value="Upload"><br>
    <br>
    

   
       
    </form>
    
   
    <?php
    // Pokušaj zapisaa svega u txt file
    $ime_datoteke = "popisStudenata.txt"; 
    $upravljac_datoteke = fopen($ime_datoteke, 'a+') or die("datoteka se ne moze otvoriti"); 
    
    if (isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['email_adresa']) && isset($_POST['smjer']) && isset($_POST['godina_studija']) && isset($_POST['motiv']) && isset($_POST['predznanje']) && isset($_POST['PhP'])&& isset($_POST['MySql'])) { // check if both fields are set
    $data=$_POST['ime'].' - '.$_POST['prezime'].' - '.$_POST['email_adresa'].' - '.$_POST['smjer'].' - '.$_POST['godina_studija'].' - '.$_POST['motiv'].' - '.$_POST['predznanje'].' - '.$_POST['PhP'].' - '.$_POST['MySql'] . "\n"; 
    $ret = file_put_contents('/tmp/popisStudenata.txt', $data, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
        echo "$ret bytes written to file";
    }
}
else {
   die('no post data to process');
}
    ?>

</main>

<footer>
    <p>&copy; PHP Akademija, 2016</p>
</footer>
    
<?php
    }
 else 
    {
//poziv skripte za spoj na mysql
    include 'spoj.php';
    $sql_forma="INSERT INTO popis_studenata(ime,prezime,email_adresa,smjer,godina_studija,motiv,predznanje,PhP,MySql)
      VALUES('$_POST[ime]','$_POST[prezime]','$_POST[email_adresa]','$_POST[smjer]','$_POST[godina_studija]','$_POST[motiv]','$_POST[predznanje]','$_POST[PhP]','$_POST[MySql]')";      
    
    //projera jesu li podatci uspješno upisani
    if(mysql_query($sql_forma))
    {
        echo 'Pohranili smo podatke o studentu. <br>';
    }
    else{
        echo 'Nismo pohranili podatke o studentu'."<br>".mysql_error();
    }
    }
    ?>
    <?php
    // Pokušaj spremanja u datoteku
    if($_FILES["datoteka_za_upload"]["error"] > 0)
    {
        echo "Error" .$_FILES["datoteka_za_upload"]["error"]."<br>";
    }
 else 
     {
    $target_path = "C:\xampp\htdocs\test\TrecePredavanje\Primjer\upload";
    $target_path =$target_path.basename($_FILES['datoteka_za_upload']['name']);
    echo "Upload:<b>" .$_FILES["datoteka_za_upload"]['name']."</b><br>";
    echo "Vrsta:<b>" .$_FILES["datoteka_za_upload"]["type"]."</b><br>";
    echo "Veličina:<b>" .($_FILES["datoteka_za_upload"]["size"]/1024)." Kb </b><br>";
    echo "Spremljena:<b>" .$_FILES["datoteka_za_upload"]["tmp_name"]."</b><br>";
    }
    if(move_uploaded_file($_FILES['datoteka_za_upload']['tmp_name'],$target_path)){
        echo "Datoteka <b>".basename($_FILES,['datoteka_za_upload']['name'])."</b> uspješno je pohranjena.";
    }
    else{
        echo"Želimo, ali datoteka nije pohranjena na poslužitelj.";
    }
    ?>
    
</body>
</html>