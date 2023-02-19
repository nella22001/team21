<?php
if (isset($_POST["nimi"]) && isset($_POST["ainekset"]) && 
    isset($_POST["ohje"])){
    $nimi=$_POST["nimi"];
    $ainekset=$_POST["ainekset"];
    $ohje=$_POST["ohje"];
}
else{
    //header("Location:omasivu.html");
    print "Sorry, some information is missing. Please try again!";
    exit;
}
$yhteys=mysqli_connect("db", "erika", "projekti");
if (!$yhteys) {
    die ("Failed to create a connection: " . mysqli_connect_error());
}
$tietokanta=mysqli_select_db($yhteys, "reseptikanta");
if (!$tietokanta) {
    die ("Failed to connect to the right database: " . mysqli_connect_error());
}

$sql="insert into reseptit(nimi, ainekset, ohje) values(?, ?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "sss", $nimi, $ainekset, $ohje);
mysqli_stmt_execute($stmt);
mysqli_close($yhteys);

header("Location:kiitos.html"); //muuta tämä!!!!!!!!!!!!!!!!!!!
exit;

?>