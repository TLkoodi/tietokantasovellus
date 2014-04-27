<?php
session_start();
require 'libs/common.php';
require 'libs/models/ainesosa.php';
require 'libs/onkoAdmin.php';

$id = $_GET['id'];

$uusiainesosa = Ainesosa::etsiAinesosa($id);

if (empty($_POST["muokattavaNimi"]) || empty($_POST["muokattavaKuvaus"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("ainesosanMuokkaus.php", array(
    'ainesosa' => $uusiainesosa,
    'virhe' => "Anna nimi ja kuvaus",
    ));
    exit();
}

$muokattavanimi = $_POST["muokattavaNimi"];
$muokattavakuvaus = $_POST["muokattavaKuvaus"];
$muokattavaid = $_POST["id"];

$uusiainesosa->setNimi($muokattavanimi);
$uusiainesosa->setKuvaus($muokattavakuvaus);
$uusiainesosa->setID($muokattavaid);

if ($uusiainesosa->onkoKelvollinenMuokattavaksi()) {
    $uusiainesosa->muokkaaAinesosaa();

    $_SESSION['ilmoitus'] = "Ainesosaa muokattu onnistuneesti.";
    //Ainesosa lisättiin kantaan onnistuneesti, lähetetään käyttäjä eteenpäin

    header('Location: ainesosalistaus.php');
    //Asetetaan istuntoon ilmoitus siitä, että ainesosa on lisätty.
} else {
    $virheet = $uusiainesosa->getVirheet();

    //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
    naytaNakyma("ainesosanMuokkaus.php", array(
        'ainesosa' => $uusiainesosa,
        'virhe' => $uusiainesosa->getVirheet()
    ));
}
