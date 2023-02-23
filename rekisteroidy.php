<?php
if (isset($_POST["tunnus"]) && isset($_POST["salasana"]) && 
    isset($_POST["etunimi"]) && isset($_POST["sukunimi"])){
    $tunnus=$_POST["tunnus"];
    $salasana=$_POST["salasana"];
    $salasana2=$_POST["salasana2"]; //salasana2 tarvitaan täällä, jotta voisi tarkistaa salasana=salasana2, mutta se ei mene tietokantaan
    $etunimi=$_POST["etunimi"];
    $sukunimi=$_POST["sukunimi"];

    // Erroreiden tarkistusta, jos salasana ei täsmää tai jotain kenttää ei täytetä niin käyttäjä saa siitä virheilmoituksen. 
    if($salasana != $salasana2) {
        die('Passwords do not match! Please try again!');
    }
    elseif(empty($etunimi)){
        die('Please fill out your first name.');
    }
    elseif(empty($sukunimi)){
        die('Please fill out your last name.');
    }
    elseif(empty($tunnus)){
        die('Please fill out your username.');
    }
    elseif(empty($salasana || $salasana2)){
        die('The password field is empty. Please try again!');
    }  
}

else{
    header("Location:rekisteroityminen.html");
    exit;
}
//Otetaan yhteys tietokantaan.
$yhteys=mysqli_connect("db", "erika", "projekti");
if (!$yhteys) {
    die ("Failed to create a connection: " . mysqli_connect_error());
}
$tietokanta=mysqli_select_db($yhteys, "reseptikanta");
if (!$tietokanta) {
    die ("Failed to connect to the right database: " . mysqli_connect_error());
}


//Sijoitetaan muuttujat sql-lauseeseen
$sql="insert into kayttaja(tunnus, salasana, etunimi, sukunimi) values(?, md5(?), ?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $tunnus, $salasana, $etunimi, $sukunimi); //järjestys pitää olla sama kuin rivi 46
mysqli_stmt_execute($stmt);
mysqli_close($yhteys);

//Rekisteröinti tehty onnistuneesti, ohjataan käyttäjä sivustolle, jossa se kerrotaan ja siellä olevasta linkistä pääsee kirjautumaan ja omille sivuille. 
header("Location:kiitos.html");
exit;
?>