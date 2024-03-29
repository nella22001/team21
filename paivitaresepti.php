<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="paivitaresepti.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}
//luetaan lomakkeelta tulleet tiedot, jos syötteet ovat olemassa
$id=isset($_POST["id"]) ? $_POST["id"] : "";
$nimi=isset($_POST["nimi"]) ? $_POST["nimi"] : "";
$ainekset=isset($_POST["ainekset"]) ? $_POST["ainekset"] : "";
$ohje=isset($_POST["ohje"]) ? $_POST["ohje"] : "";

//Jos joku tieto puuttuu
if (empty($nimi) || empty($ainekset) || empty($ohje)){
    print "Do not leave any fields empty!"; //Tulosti tämän, koska $id puuttui listauksesta ylhäältä, korjattu
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
    //$yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
}
catch(Exception $e){
    print "Could not connect to the database!";
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="update reseptit set nimi=?, ainekset=?, ohje=? where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sssi', $nimi, $ainekset, $ohje, $id);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:muokataanresepti.php");
exit;
?>