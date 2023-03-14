<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="profilepage.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.html"); //ohjataan käyttäjä kirjautumaan
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
    <title>Recipe World - My page</title>
</head>
<body>
<div class="background_image"><!--background-->

<?php //header tässä kun ollaan php tiedostoissa
include ("header.html");
?>

<?php //sivunavigointi reseptien lisäys,poisto, muokkaus aina kun ollaan omilla sivuilla
include ("sidenav.html");
?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br> <!--container josta löytyy käyttäjän tietoja, tässä tapauksessa käyttäjätunnus koska ei haluttu muuta-->
         <div class="parent-container d-flex" style="background-color: rgb(244, 233, 233);">
            <div class="container">
                <div class="row">
                    <div class="col" style="margin-left: 10em;">
                        <br>
                        <br>
                        <br>
                        <?php //session laittaa talteen, kuka on kirjautunut, tervehditään käyttäjää
                        print "<h2>Welcome, ".$_SESSION["user_ok"]."!</h2>";                     
                        ?>

                    </div>
                </div>
            </div>
        </div>
<!--TÄMÄ VERSIO KÄYTTÄÄ AJAXIA/JSONIA RESEPTIEN HAKEMISEEN, TIEDOSTOT HAERESEPTIT.PHP JA HAEYKSIRESEPTI.PHP-->
        <div class="parent-container d-flex">
            <div class="container">
                <div class="row">
                    <div class="col" style="margin-left:5em; margin-top: 5em;">
                        <h4>My recipes</h4>
                        <br>
                        <script>
                        //Ensimmäinen funktio kaikkien reseptien nimien hakemiseen
                        function haereseptit() { //funktio buttonia varten, jotta button toimii
                            xmlhttp = new XMLHttpRequest(); //osaa tehdä requestin
	                        xmlhttp.onreadystatechange = function() {
	                        if (this.readyState == 4 && this.status == 200) {
		                        document.getElementById("result").innerHTML = this.responseText; //result paikassa tulostaa kaikki teksti, mitä löytyi
	                        }
	                    };
	                    xmlhttp.open("GET", "./haereseptit.php", true); //tämä ainoastaan hakee reseptit tietokannasta, ei vielä tulosta
	                    xmlhttp.send();	
                        }
                        //Toinen funktio yksittäisen reseptin tietojen hakemiseen
                        function haeyksiresepti(indeksi) {
                            xmlhttp = new XMLHttpRequest(); //osaa tehdä requestin
	                        xmlhttp.onreadystatechange = function() {
	                        if (this.readyState == 4 && this.status == 200) {
		                        document.getElementById("haetaan").innerHTML = this.responseText; //haetaan paikassa tulostaa kaikki teksti, mitä löytyi
                            }
	                    };
	                    xmlhttp.open("GET", "./haeyksiresepti.php?haetaan="+indeksi, true); //tämä hakee yhden reseptin indeksin perusteella
	                    xmlhttp.send();	
                        }
                        </script>
                        <button class="button" onclick="haereseptit();">Show my recipes!</button><br><br>
                        <br>
                        <div id='result'>
                            <!--tänne tulostetaan funktio haereseptit-->
                        </div>
                        <div id='haetaan'>
                            <!--tänne tulostetaan funktio haeyksiresepti-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div><!--background ends-->

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    </body>
</html>
