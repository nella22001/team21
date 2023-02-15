<?php
session_start();

if (!isset($_SESSION["user_ok"])){
	$_SESSION["paluuosoite"]="vaatiikirjautumisen.php";
	header("Location:kirjaudu.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Vaatii kirjautumisen</title></head>
<body>
<?php 
print "Tiedosto vaatiikirjautumisen.php";
?>
<p>Kirjautuminen OK!</p>
</body>
</html>