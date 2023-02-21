<?php
if (isset($_POST["tunnus"]) && isset($_POST["salasana"]) && 
    isset($_POST["etunimi"]) && isset($_POST["sukunimi"])){
    $tunnus=$_POST["tunnus"];
    $salasana=$_POST["salasana"];
    $salasana2=$_POST["salasana2"]; //salasana2 tarvitaan täällä, jotta voisi tarkistaa salasana=salasana2, mutta se ei mene tietokantaan
    $etunimi=$_POST["etunimi"];
    $sukunimi=$_POST["sukunimi"];
    if($salasana != $salasana2) {
        die('Passwords do not match! Please try again!');
    }
    print "<table border='0'>";
    print "<tr><td>";
    if(empty($tunnus)){
        echo "Please fill out username field.";
    }
    print "<tr><td>";
    if(empty($salasana || $salasana2)){
        echo "Please fill out both password fields.";
    }
    print "<tr><td>";
    if(empty($etunimi)){
        echo "Please fill out firstname field.";
    }
    print "<tr><td>";
    if(empty($sukunimi)){
        echo "Please fill out lastname field.";   
    }exit;
}
else{
    header("Location:rekisteroityminen.html");
    // tai tulosta print "Sorry, some information is missing or the username $tunnus is already registered. Please try again." Pitää vielä testata
    exit;
}
$yhteys=mysqli_connect("db", "erika", "projekti");
if (!$yhteys) {
    die ("Failed to create a connection: " . mysqli_connect_error());
}
$tietokanta=mysqli_select_db($yhteys, "reseptikanta");
if (!$tietokanta) {
    die ("Failed to connect to the right database: " . mysqli_connect_error());
}

// print "$tunnus, $salasana, $etunimi, $sukunimi"; debuggia

$sql="insert into kayttaja(tunnus, salasana, etunimi, sukunimi) values(?, md5(?), ?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $tunnus, $salasana, $etunimi, $sukunimi); //järjestys pitää olla sama kuin rivi 31
mysqli_stmt_execute($stmt);
mysqli_close($yhteys);

header("Location:kiitos.html");
exit;
?>