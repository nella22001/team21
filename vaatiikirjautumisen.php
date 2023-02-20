<?php
//sellainen php tiedosto, jonka käynnistäminen vaatii kirjautumisen
//rekisteröityneet käyttäjät pystyy tätä tiedostoa käyttämään
//kirjautumistietoa voidaan ylläpitää sessiossa, sessio on palvelimella ylläpidettävä tietovarasto (vähän niin kuin taulukkokin)
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="vaatiikirjautumisen.php"; //laitetaan sessioon talteen, minne oltiin menossa
	header("Location:kirjaudu.php"); //ohjataan käyttäjä kirjautumaan
	exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Recipe World - you must sign in!</title></head>
<body>
<?php 
print "Tiedosto vaatiikirjautumisen.php";
?>
<p>Kirjautuminen OK!</p>
</body>
</html>