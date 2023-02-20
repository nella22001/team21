<?php //tämä tulostaa taulun
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
}
catch(Exception $e){
    print "Yhteysvirhe!";
    exit;
}

$tulos=mysqli_query($yhteys, "select nimi from reseptit");
while ($rivi=mysqli_fetch_object($tulos)) { 
    print "$rivi->nimi <button onclick='haeYksiResepti($rivi->id);'>Muokkaa</button>";
}
?>