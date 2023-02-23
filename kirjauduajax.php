<?php
session_start();
$json=isset($_POST["user"]) ? $_POST["user"] : ""; //avaimella user tulee json muotoisena merkkijonona lomakkeen tiedot, tallennetaan muuttujaan $json
if (!($user=tarkistaJson($json))){ //ohjelma tarkistajson muuttaa merkkijonon php olioksi
    print "Please fill all the required fields!";
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "erika", "projekti", "reseptikanta");
}
catch(Exception $e){
    print "Could not connect to the database!";
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="select * from kayttaja where tunnus=? and salasana=md5(?)";
try{
    //Valmistellaan sql-lause
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'ss', $user->tunnus, $user->salasana);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
    //Koska luetaan prepared statementilla, tulos haetaan
    //metodilla mysqli_stmt_get_result($stmt);
    $tulos=mysqli_stmt_get_result($stmt);
    if ($rivi=mysqli_fetch_object($tulos)){ //jos saadaan ainakin ja toivottavasti vaan yksi tulos
        $_SESSION["user_ok"]="$rivi->tunnus"; //käyttäjän tunnus tallennetaan sessioon avaimella kayttaja
        print "ok";
        exit;
    }
    //Suljetaan tietokantayhteys
    mysqli_close($yhteys);
    print $json;
}
catch(Exception $e){
    print "Oh no, something went wrong!";
}
?>


<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $user=json_decode($json, false);
    if (empty($user->tunnus) || empty($user->salasana)){
        return false;
    }
    return $user;
}
?>