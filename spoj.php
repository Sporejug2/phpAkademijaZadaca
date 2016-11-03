<?php
//funkcija za spoj na mysql poslužitelj
if(!$spoj=@mySQL_connect("localhost","root",""))
{
    die("<b> Došlo je do pogreške i nismo se mogli spojiti na MySQL poslužitelj</b>");
}
//funkcija za odabir baze na poslužitelju
if(!mySQL_select_db("studenti",$spoj))
{
    die("<b> Odabrana je pogrešna baza podataka.</b>");
}
?>


