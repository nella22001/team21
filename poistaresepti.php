<?php
$poistettava = isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";

if (empty($poistettava)) { // jos poistettava on tyhjä, hypätään toiseen ohjelmaan
    header("Location:profilepage.php");
    exit; //lopetetaan tämän ohjelma ja hypätään pois
}
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{ //olio $yhteys, antaa yhteyden tietokantaan
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta"); //jollekin palvelimelle, jollakin salasanalla ja käyttäjätunnuksella, johonkin tietokantaan
}
catch(Exception $e){
    print "Could not connect to the database!";
    exit;
}

$sql="delete from reseptit where id=?"; //prepared statement, aina kuin ulkoa tulee jotain

//Valmistellaan sql-lause, käydään tätä yhteyttä ja sql lauseella luodaan statement olio
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'i', $poistettava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
mysqli_close($yhteys);

header("Location:poistetaanresepti.php");
exit;
?>