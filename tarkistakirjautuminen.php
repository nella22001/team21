<?php
//TÄTÄ NYT EI KÄYTETÄ KUN KIRJAUTUMINEN TAPAHTUU AJAXILLA
session_start(); //session start lause mahdollistaa session olion käyttämisen
if (!isset($_SESSION["paluuosoite"])){
    $_SESSION["paluuosoite"]="profilepage.php"; //ei ole paluuosoitetta kun vasta tultiin
}
if (isset($_POST["tunnus"]) && isset($_POST["salasana"])){
    $tunnus=$_POST["tunnus"];
    $salasana=$_POST["salasana"];
}
else{
    header("Location:kirjaudu.html");
    exit;
}

$yhteys=mysqli_connect("db", "erika", "projekti");
//$yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816");
$tietokanta=mysqli_select_db($yhteys, "reseptikanta");
//$tietokanta=mysqli_select_db($yhteys, "trtkp22a3");

$sql="select * from kayttaja where tunnus=? and salasana=md5(?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ss", $tunnus, $salasana);
mysqli_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt); //käytettiin selectiä ja prepared statementia, saadaan vastaus $tuloksella

if ($rivi=mysqli_fetch_object($tulos)){ //jokin tulos löytyi
    $_SESSION["user_ok"]="ok";
    header("Location:".$_SESSION["paluuosoite"]); //kirjautuminen onnistui, ohjataan pyyntö sinne, minne oltiin alunperin menossa
    exit;
}
else{ //tulosta ei löytynyt
    header("Location:kirjaudu.html"); //lähetetään käyttäjä uudestaan kirjautumaan
    exit;
} 

?>