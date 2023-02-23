<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="uusiresepti.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}

if (isset($_POST["nimi"]) && isset($_POST["ainekset"]) && isset($_POST["ohje"])) {
    $nimi=$_POST["nimi"];
    $ainekset=$_POST["ainekset"];
    $ohje=$_POST["ohje"];
}
else {
    print "Please fill out all the fields!";
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
}
catch(Exception $e){
    print "Could not connect to the database!";
    exit;
}

if (!empty($nimi) && !empty($ainekset) && !empty($ohje)) { //lisääminen if loopin sisään jotta voisi käyttää headeria loopin lopussa
    //Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
    //joihin laitetaan muuttujien arvoja
    $sql="insert into reseptit (nimi, ainekset, ohje) values(?, ?, ?)";
    //Valmistellaan sql-lause
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'sss', $nimi, $ainekset, $ohje);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);

    $last_id=mysqli_insert_id($yhteys); //otetaan viimeksi lisätyn reseptin id talteen lapsitauluun yhdistämistä varten

    foreach ($reseptit as $minuntreseptit){
        $sql="insert into minunreseptit(rid, ktunnus) values (?, ?)";
        $stmt=mysqli_prepare($yhteys, $sql);
        mysqli_stmt_bind_param($stmt, 'is', $last_id, $minunreseptit); 
        mysqli_stmt_execute($stmt);
    }

    header("Location:uusiresepti.php"); //headerin funktio: ei enää lähetetä tietoa tietokantaan uudestaan, kun painaa refresh
    exit;
}
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:profilepage.php");
exit;
?>