<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="muokkaaresepti.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
	exit;
}

$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";

//syötteen tarkistus, ettei avata tietokantaa turhaan
//Jos tietoa ei ole annettu, palataan omalle sivulle
if (empty($muokattava)){
    header("Location:profilepage.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
}
catch(Exception $e){
    print "Could not connect to the database!";
    exit;
}

$sql="select * from reseptit where id=?"; //prepared statement, aina kuin ulkoa tulee jotain

$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttuja sql-lauseeseen
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Koska luetaan prepared statementilla, tulos haetaan 
//metodilla mysqli_stmt_get_result($stmt);
$tulos=mysqli_stmt_get_result($stmt);
if (!$rivi=mysqli_fetch_object($tulos)){
    print "No such information was found!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Erika Mikonmaa, Heidi Nuust, Helmi Mikkola and Nella Järvenpää">
    <meta name="description" content="Having trouble with what to cook for dinner? Welcome to the most comprehensive online recipe collection. Recipe world has all the recipes you could ever dream of and more.">
    <meta name="keywords" content="recipe, food, chef, breakfast, lunch, dinner, vegan, paleo">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Recipe World - Edit recipe</title>
</head>
<body>
<div class="background_image"><!--background-->
<?php
include ("header.html");
include ("sidenav.html");
?>
<br><br><br><br><br><br><br><br><br><br><br>
<div class="parent-container d-flex">
    <div class="container">
        <div class="row">
            <div class="col" style="margin-left:5em; margin-top: 5em;">
                <form action='paivitaresepti.php' method='post'>
                    <input type='text' name='id' value='<?php print $rivi->id;?>' readonly><br>
                    <label for='nimi'>Name of the recipe:</label><br>
                    <input id=kursori type='text' name='nimi' value='<?php print $rivi->nimi;?>'><br>

                    <label for='ainekset'>Ingredients:</label><br> <!-- EI NÄY print $rivi->ainekset;!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
                    <textarea name='ainekset' cols='70' rows='15'><?php print $rivi->ainekset;?></textarea><br><br>

                    <label for='ohje'>Cooking instructions:</label><br>
                    <textarea name='ohje' cols='70' rows='15'><?php print $rivi->ohje;?></textarea><br><br>

                    <input type='submit' name='ok' value='Update'><br><br>
                </form>
                <script>
                    kursori.focus();
                </script>
            </div>
        </div>
    </div>
</div>
<?php
//Suljetaan tietokantayhteys
//mysqli_close($yhteys);
?>