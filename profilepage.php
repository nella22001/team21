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
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Recipe World - My page</title>
</head>
<body>

<?php
$yhteys=mysqli_connect("db", "erika", "projekti");
if (!$yhteys) {
    die ("Failed to create a connection: " . mysqli_connect_error());
}
$tietokanta=mysqli_select_db($yhteys, "reseptikanta");
if (!$tietokanta) {
    die ("Failed to connect to the right database: " . mysqli_connect_error());
}
 //Kyselyn tekeminen 
 $tulos=mysqli_query($yhteys, "select * from reseptikanta");
?>


    
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
                 </div>
                 <div class="sidenav">
                <a href="lisaaresepti.php"><button class="button">Add a recipe</button></a>
                <a href="#"><button class="button">Change recipes</button></a>
                <a href="#"><button class="button">Delete recipes</button></a>
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
         <br>
         <div class="parent-container d-flex" style="background-color: rgb(244, 233, 233);">
            <div class="container">
                <div class="row">
                    <div class="col" style="margin-left: 10em;">
                        <br>
                        <br>
                        <br>
                        <?php
                        $tulos=mysqli_query($yhteys, "select tunnus from reseptikanta");
                        while ($rivi=mysqli_fetch_object($tulos)) {
                            print "$rivi->tunnus: $rivi->laji<br>\n";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="parent-container d-flex">
            <div class="container">
                <div class="row">
                    <div class="col" style="margin-left:5em; margin-top: 5em;">
                        <h4>My recipes</h4>
                        <br>
                        <?php
                         $tulos=mysqli_query($yhteys, "select * from reseptit");
                         //<span>Name:</span>
                         echo $yhteys['nimi'];

?>
                        <a href="https://nella22001.github.io/team21/recipe.html">Tom yum goong</a>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
mysql_close($yhteys); // Closing Connection with Server
?>

<a href="kirjauduulos.php">Sign out</a>
        </div><!--background ends-->

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    </body>
</html>
