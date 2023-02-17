<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <style>
        h2{text-align: center;
        margin-top: 250px;}
        form{text-align: center;}
        p{margin-bottom: 250px;}
       
    
    </style>
</head>
<body>
    <?php
   
    print "<h2>Log in</h2>";
    ?>
    
    <form action='tarkistakirjautuminen.php' method='post'>
    Username: <input type='text' name='tunnus' value=''><br><br>
    Password: <input type='password' name='salasana' value=''><br><br>   
    <input type='submit' name='ok' value='Log in'><br><br>
    <p>Don't have an account yet? Create your account <a href=rekisteroityminen.html>here</a></p>
   
</form>  
   
</body>
</html>