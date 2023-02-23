<?php //poistetaan sessiosta avaimella user_ok olevan arvon
session_start();
unset($_SESSION["user_ok"]);
header("Location:index.html");
?>