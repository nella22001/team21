<!--ottaa vastaan tiedot rekisteroi.html ja tallentaa ne tietokantaan-->
<?php
//ensin tutkitaan, saadaanko sellaiset syötteet kuin mitä halutaan, jos ei saada, ohjataan takaisin rekisteroi.html tiedostoon
if (isset($_POST["tunnus"]) && isset($_POST["salasana"]) &&
 isset($_POST["etunimi"]) && isset($_POST["sukunimi"])) {
    $tunnus=$_POST["tunnus"]; //eli kaikki oli ok, annetaan nämä arvot tietokantaan
    $salasana=$_POST["salasana"];
    $salasana2=$_POST["salasana2"]; //tarvitaanko tätä riviä? tai haittaako se, kun ei ole tietokannassa salasana2 eikä sitä sinne haluta?
    $etunimi=$_POST["etunimi"];
    $sukunimi=$_POST["sukunimi"];
    if($salasana != $salasana2) die('Passwords do not match!');
 }
 else { //kaikki tiedot ei ollut ok, ohjataan takaisin
    header ("Location:rekisteroi.html");
    // tai tulosta print "Sorry, some information is missing or the username $tunnus is already registered. Please try again."
    exit;
 }
//seuraavaksi tarvitaan yhteys tietokantaan
$yhteys=msqli_connect("db", "heidi", "salainen"); //kun laitetaan shell.hamk.fi:hin, tulee "db" tilalle "localhost"
//valitaan tietokanta seuraavaksi
//??????????? tähän vielä uudelleenohjaus, jos on ongelmia
$tietokanta=myqsli_select_db($yhteys, "reseptikanta"); //tarvitaan muuttujaa yhteys ja tietokannan nimeä
//sql lause, lisäyslause, käytetään prepared statementia eli values on vaan kysymysmerkkejä 
//??????????? tähän vielä uudelleenohjaus, jos on ongelmia
$sql="insert into kayttaja values(?, ?, ?, ?)"; //sarakkeita ei tarvi eritellä, koska jokaiseen laitetaan tietoa, yksikään ei jää tyhjäksi
//valmistellaan sql lause, tarvitsee parametrit yhteys ja sql
$stmt=mysqli_prepare($yhteys, $sql);
//lisätään sql lauseeseen arvot kysymysmerkkien sijaan
mysqli_stmt_bind_param($stmt, "ssss", $tunnus, md5($salasana), $etunimi, $sukunimi); //?????????????onko järjestyksellä väli tässä vs ylhäällä isset??????????
//ensimmäinen parametri pitää olla satement, sitten tietotyypit eli tässä merkkijonot, sitten mitä arvoja sinne laitetaan
//md5 on msql kryptaus salasanalle
//seuraavaksi statementin suoritus
mysqli_stmt_execute($stmt);
//ohjelma on valmis, mutta se ei tulosta mitään, joten laitetaan loppuun jonkinlainen tulostus

header("Location:kiitos.html");
exit; //ohjelman viimeinen rivi, ei periaatteessa tarvi laittaa exitiä
?>