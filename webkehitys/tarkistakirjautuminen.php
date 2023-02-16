<?php
session_start();
if (isset($_POST["tunnus"]) && isset($_POST["salasana"])){
    $tunnus=$_POST["tunnus"];
    $salasana=$_POST["salasana"]
}
else{
    header("Location:rekisteroityminen.html");
    exit;
}

$yhteys=mysqli_connect("db", "pena ", "kukkuu");
$tietokanta=mysqli_select_db($yhteys, "poj_userdata");

$sql="select * from poj_users where tunnus=? and salasana=md5(?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ss", $tunnus, $salasana);
mysqli_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);

if ($rivi=mysqli_fetch_object($tulos)){
    $_SESSION["user_ok"]="ok";
    header("Location:".$_SESSION["paluuosoite"]);
    exit;
}
else{
    header("Location:kirjaudu.php");
    exit;
}
?>