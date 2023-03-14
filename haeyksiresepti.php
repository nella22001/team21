<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="haeyksiresepti.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$id=isset($_GET["haetaan"]) ? ($_GET["haetaan"]) : "";
try{
    //$yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
}
catch(Exception $e){
    print "Something went wrong, could not connect to the database!";
    exit;
}

$tulos=mysqli_query($yhteys, "select * from reseptit where id=$id"); //lukee yhden ainoan reseptin
if ($rivi=mysqli_fetch_object($tulos)) { 
    $resepti=new class{}; //tehdään uusi olio
    $resepti->id=$rivi->id;
    $resepti->nimi=$rivi->nimi;
    $resepti->ainekset=$rivi->ainekset;
    $resepti->ohje=$rivi->ohje;
    print json_encode($resepti);
    //print "$rivi->nimi<br>$rivi->ainekset<br>$rivi->ohje<br>";
}
?>