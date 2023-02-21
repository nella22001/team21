<?php
session_start();

unset($_SESSION["user_ok"]);
header("Location:index.html");
?>