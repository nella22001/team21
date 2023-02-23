<?php //MUOKATTAVAA TÄSSÄ??!!
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="profilepage.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}
?>
<?php

$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";

//Jos tietoa ei ole annettu, palataan omalle sivulle
//if (empty($muokattava)){
    //header("Location:profilepage.php");
    //exit;
//}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
}
catch(Exception $e){
    print "Could not connect to the database!";
    exit;
}

$sql="select * from reseptit where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttuja sql-lauseeseen
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Koska luetaan prepared statementilla, tulos haetaan 
//metodilla mysqli_stmt_get_result($stmt);
$tulos=mysqli_stmt_get_result($stmt);
//if (!$rivi=mysqli_fetch_object($tulos)){
    //print "No such information was found!";
    //exit;
//}
?>
<form action='paivitaresepti.php' method='post'>
 <!-- <input type='text' name='id' value='<?php //print $rivi->nimi;?>' readonly><br> -->
 <label for='nimi'>Name of the recipe:</label><br>
   <input id=kursori type='text' name='nimi' value='<?php print $rivi->nimi;?>'><br>

    <label for='ainekset'>Ingredients:</label><br>
    <textarea name='ainekset' cols='70' rows='15' value='<?php print $rivi->ainekset;?>'></textarea><br><br>

    <label for='ohje'>Cooking instructions:</label><br>
    <textarea name='ohje' cols='70' rows='15' value='<?php print $rivi->ohje;?>'></textarea><br><br>

    <input type='submit' name='ok' value='Update'><br>
</form>
<script>
    kursori.focus();
</script>

<?php
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
?>