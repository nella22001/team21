<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="haeomatreseptit.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}

$haettava=isset($_GET["haettava"]) ? $_GET["haettava"] : "";

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
}
catch(Exception $e){
    print "Could not connect to the database!";
    exit;
}

$tulos=mysqli_query($yhteys, "select (nimi, ainekset, ohje) from reseptit where id=?");
while ($rivi=mysqli_fetch_object($tulos)){
    print "<p>$rivi->nimi<br>$rivi->ainekset<br>$rivi->ohje</p>";
}
mysqli_close($yhteys);

?>