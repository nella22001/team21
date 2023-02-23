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
    <title>Muokkaa reseptiä</title>
</head>
<body> <!--Tulostaa reseptit-->
<div class="background_image"><!--background-->
  
  <header class="page-header header container-fluid text-center">
   
   <nav class="navbar navbar-expand-md"> <!--navigation bar with a logo-->
      <a href="index.html"><img class="navbar-brand" src="assets/images/RecipeWorld.png" alt="Recipe World Logo"style="margin-left:10em;"></a>
       <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="main-navigation">
           <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href="kirjaudu.html">Sign in</a>
              </li>
               <li class="navbar-item">
                   <a class="nav-link" href="index.html">Home</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="category.html">Recipes</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="contact.html">Contact</a>
               </li>
           </ul>
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
           <div class="parent-container d-flex" style="background-color: rgb(244, 233, 233);">
            <div class="container">
                <div class="row">
                    <div class="col" style="margin-left: 10em;">
                        <br>
                        <br>
                        <br>
                        <?php
                        //if (isset($_SESSION["user_ok"])){
                            $yhteys=mysqli_connect("db", "erika", "projekti");
                            $tietokanta=mysqli_select_db($yhteys, "reseptikanta");
                            $tulos=mysqli_query($yhteys, "select * from reseptit");
                        print "<h2>Welcome, ".$_SESSION["user_ok"]."!</h2>";                        
                        ?>

                    </div>
                </div>
            </div>
        </div>
<div class="parent-container d-flex">
<div class="container">
<div class="row">
                    <div class="col" style="margin-left:5em; margin-top: 5em;">
<?php
  $yhteys=mysqli_connect("db", "erika", "projekti");
  $tietokanta=mysqli_select_db($yhteys, "reseptikanta");
  $tulos=mysqli_query($yhteys, "select * from reseptit");
                         $tulos=mysqli_query($yhteys, "select * from reseptit");
                         while ($rivi=mysqli_fetch_object($tulos)){
                            print "$rivi->nimi<br>\n";
                        }
                        ?>
                        <a href="muokkaaresepti.php"><button class="button">Edit recipe</button></a>
                        </div>
                        </div>
            </div>
        </div>