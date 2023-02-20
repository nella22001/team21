<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="uusiresepti.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}



$json=isset($_POST["reseptit"]) ? $_POST["reseptit"] : "";

if (!($reseptit=tarkistaJson($json))){
    print "Fill out all the fields, some information is missing!";
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
if (isset($reseptit->nimi) && $reseptit->nimi>0) { //tehdään päivitys
    $sql="update reseptit set ainekset=?, ohje=? where nimi=?";
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $reseptit->ohje, $reseptit->ainekset, $reseptit->nimi);
} else { //tai tehdään lisäys
//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="insert into reseptit (nimi, ainekset, ohje) values(?, ?, ?)";
//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sss', $reseptit->nimi, $reseptit->ainekset; $reseptit->ohje);
}
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
print "Paluupostina jsonia ".$json;
?>


<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $reseptit=json_decode($json, false);
    if (empty($reseptit->nimi) || empty($reseptit->ainekset) || empty($reseptit->ohje) )){
        return false;
    }
    return $respetit;
}
?>