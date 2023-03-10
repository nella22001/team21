<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="haeomatreseptit.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}

$haettava=isset($_GET["haettava"]) ? $_GET["haettava"] : "";

if (empty($haettava)) {
    print "Information is missing, cannot proceed!";
    exit;
}
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
//$tk=parse_ini_file(".ht.asetukset.ini");
try{
    //$yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta"); //jos ei oteta ht.asetukset käyttöön
    $yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
    //$yhteys=mysqli_connect($tk["databaseserver"],  $tk["username"], $tk["password"], $tk["database"]); //jos otetaan ht.asetukset käyttöön
}
catch(Exception $e){
    print "Could not connect to the database!";
    exit;
}


//KORJAA TÄMÄ KOODI, resulti tulee statementilta
$sql="select (nimi, ainekset, ohje) from reseptit where id=?";
//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sss', $nimi, $ainekset, $ohje);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
$tulos=mysqli_query($yhteys, "select (nimi, ainekset, ohje) from reseptit where id=?"); //team21_reseptit esimerkiksi taulun nimeksi!!! kaikki taulun nimet silleen!!!
while ($rivi=mysqli_fetch_object($tulos)){
    print "<p>$rivi->nimi<br>$rivi->ainekset<br>$rivi->ohje</p>";
}
mysqli_close($yhteys);

?>