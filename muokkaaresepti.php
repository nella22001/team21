<?php
$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";

//Jos tietoa ei ole annettu, palataan listaukseen
if (empty($muokattava)){
    header("Location:profilepage.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "henkilokanta");
}
catch(Exception $e){
    print "Error in connecting to database!";
    exit;
}

$sql="select * from resepti where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttuja sql-lauseeseen
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Koska luetaan prepared statementilla, tulos haetaan 
//metodilla mysqli_stmt_get_result($stmt);
$tulos=mysqli_stmt_get_result($stmt);
if (!$rivi=mysqli_fetch_object($tulos)){
    header("Location:../html/tietuettaeiloydy.html");
    exit;
}
?>

<!-- Lomake tavallisena html-koodina php tagien ulkopuolella -->
<!-- Lomake sisältää php-osuuksia, joilla tulostetaan syötekenttiin luetun tietueen tiedot -->
<!-- id-kenttä on readonly, koska sitä ei ole tarkoitus muuttaa -->

<form action='./paivitahenkilo.php' method='post'>
ID:<input type='text' name='id' value='<?php print $rivi->id;?>' readonly><br>
Etunimi:<input type='text' name='etunimi' value='<?php print $rivi->etunimi;?>'><br>
Sukunimi:<input type='text' name='sukunimi' value='<?php print $rivi->sukunimi;?>'><br>
<input type='submit' name='ok' value='ok'><br>
</form>
<!-- loppuun uusi php-osuus -->
<?php
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
?>