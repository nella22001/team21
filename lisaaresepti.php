<?php
session_start();
//tutkitaan, onko olemassa käynnissäolevaa kirjautumista
if (!isset($_SESSION["user_ok"])){ //jos sessioniin ei ole laitettu sellaista user ok arvoa, käyttäjä ei ole kirjautunut
	$_SESSION["paluuosoite"]="lisaaresepti.php"; //laitetaan sessioon talteen, minne oltiin menossa
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <title>Recipe World - Add your repice</title>
    <style>
            h2{
                text-align: center;
                color:#452e29 ;
            }
            p{
                text-align: center;
            }
            form{
                width:230px;
                text-align: center; 
                margin: 0 auto; 
    
            }
            body{
                text-align: center;
            } 
        </style>
    </head>
    <body>
     <div class="background_image"><!--background-->   
    
    <header class="page-header header container-fluid text-center">

            <nav class="navbar navbar-expand-md"> <!--navigation bar with a logo-->
                <a href="index.html"><img class="navbar-brand" src="assets/images/RecipeWorld.png" alt="Recipe World Logo"></a>
                <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main-navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="kirjaudu.html">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.html">Recipes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                    </ul>
                    
                </div>
            </nav>
    </header>   
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
   <h2>Add your recipe here</h2> 
   <p>Fill out all the fields to add your recipe.</p>
   
   
   <form action='uusiresepti.php' method='post'>
    <label for='nimi'>Name of the recipe:</label><br>
    <input id=kursori type='text' name='nimi' value=''><br>

    <label for='ainekset'>Ingredients:</label><br>
    <textarea name='ainekset' cols='70' rows='15'></textarea><br><br>

    <label for='ohje'>Cooking instructions:</label><br>
    <textarea name='ohje' cols='70' rows='15'></textarea><br><br>

    <input type='submit' name='ok' value='Submit'><br>
   </form>
   <script>
        kursori.focus();
   </script>
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
   <br>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>   
</div><!--background ends-->
</body>
</html>