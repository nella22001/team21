<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="poistaresepti.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}
$poistettava = isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";

if (empty($poistettava)) { // jos poistettava on tyhjä, hypätään toiseen ohjelmaan
    header("Location:profilepage.php");
    exit; //lopetetaan tämän ohjelma ja hypätään pois
}
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{ //olio $yhteys, antaa yhteyden tietokantaan
    $yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
   // $yhteys=mysqli_connect($tk["databaseserver"],  $tk["username"], $tk["password"], $tk["database"]); //jos otetaan ht.asetukset käyttöön //palvelin, käyttäjätunnus, salasana, tietokanta
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