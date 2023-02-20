<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="haeyksiresepti.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$id=isset($_GET["muokattava"]) ? ($_GET["muokattava"]) : "";
try{
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
}
catch(Exception $e){
    print "Yhteysvirhe!";
    exit;
}

$tulos=mysqli_query($yhteys, "select * from koira where nimi=$nimi"); //lukee yhden ainoan reseptin
if ($rivi=mysqli_fetch_object($tulos)) { 
    $reseptit=new class{}; //tehdään uusi olio
    $reseptit->nimi=$rivi->nimi; //sarakkeen nimet samoin kuin tietokannassa, esim iso alkukirjain
    $reseptit->ainekset=$rivi->ainekset;
    $reseptit->ohje=$rivi->ohje;
    print json_encode($reseptit);
}
?>