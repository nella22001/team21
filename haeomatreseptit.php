<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="haeomatreseptit.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
}
catch(Exception $e){
    print "Yhteysvirhe!";
    exit;
}

$tulos=mysqli_query($yhteys, "select nimi from reseptit where tunnus is ?");
print "<table border='1'>";
while ($rivi=mysqli_fetch_object($tulos)) { 
    print "<tr>";
    print "<td>$rivi->nimi<td>$rivi->ainekset<td>$rivi->ohje<td><button onclick='haeomatreseptit($rivi->nimi);'>Muokkaa reseptia</button>";
}
print "</table>";

//$tulos=mysqli_query($yhteys, "select nimi from reseptit");
//while ($rivi=mysqli_fetch_object($tulos)) { 
//    print "$rivi->nimi <button onclick='haeYksiResepti($rivi->id);'>Muokkaa</button>";
//}
?>