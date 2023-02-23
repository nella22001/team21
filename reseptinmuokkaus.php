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