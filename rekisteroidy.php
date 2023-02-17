<?php
if (isset($_POST["tunnus"]) && isset($_POST["salasana"]) && 
    isset($_POST["etunimi"]) && isset($_POST["sukunimi"])){
    $tunnus=$_POST["tunnus"];
    $salasana=$_POST["salasana"];
    $salasana2=$_POST["salasana2"]; //tarvitaanko tätä riviä? tai haittaako se, kun ei ole tietokannassa salasana2 eikä sitä sinne haluta?
    $etunimi=$_POST["etunimi"];
    $sukunimi=$_POST["sukunimi"];
    if($salasana != $salasana2) {
        die('Passwords do not match!');
        exit;
}
else{
    header("Location:rekisteroityminen.html");
    // tai tulosta print "Sorry, some information is missing or the username $tunnus is already registered. Please try again." Pitää vielä testata
    exit;
}
}
$yhteys=mysqli_connect("db", "erika", "projekti");
if (!$yhteys) {
    die ("Failed to make a connection: " . mysqli_connect_error());
}
$tietokanta=mysqli_select_db($yhteys, "reseptikanta");
if (!$tietokanta) {
    die ("Failed to connect to the right database: " . mysqli_connect_error());
}
$sql="insert into kayttaja values(?, md5(?), ?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $tunnus, $salasana, $etunimi, $sukunimi); //???????jäjestyksellä väliä, täällä vs ylhäällä isset?
mysqli_stmt_execute($stmt);
mysqli_close($yhteys);

header("Location:kiitos.html");
exit;

?>