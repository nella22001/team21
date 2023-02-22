<!DOCTYPE html>
<html>
<head>
    <meta name="author" content="Erika Mikonmaa, Heidi Nuust, Helmi Mikkola and Nella Järvenpää">
    <meta name="description" content="Having trouble with what to cook for dinner? Welcome to the most comprehensive online recipe collection. Recipe world has all the recipes you could ever dream of and more.">
    <meta name="keywords" content="recipe, food, chef, breakfast, lunch, dinner, vegan, paleo">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <title>Recipe World - Log in</title>
   <style>
        h2{
            text-align: center;
            margin-top: 300px;
            color:#452e29 ;
        }
        form{  
            text-align: center;
            margin: 0 auto;
            width:230px;
        }
        p{
            margin-bottom: 250px;
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
   
    <h2>Log in</h2>
   
    <form action='tarkistakirjautuminen.php' method='post'>
    Username: <input id=kursori type='text' name='tunnus' value=''><br><br>
    Password: <input type='password' name='salasana' value=''><br><br>   
    <input type='submit' name='ok' value='Log in'><br><br>
    <p>You do not have an account? Create your account <a href=rekisteroityminen.html>here</a></p>
    </form>
    <script>
        kursori.focus();
    </script>

<?php
if($error)
    <script> alert ("Wrong username or password, try again!")</script>
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
   <br> 
</div><!--background ends-->   
</body>
</html>