<?php
session_start();
require 'libs/common.php';
require 'libs/models/drinkki.php';
require 'libs/onkoAdmin.php';

$nimi = $_GET['id'];

$uusidrinkki = Drinkki::etsiDrinkki($nimi);

if (empty($_POST["muokattavaNimi"]) || empty($_POST["muokattavaValmistusohje"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("drinkinMuokkaus.php", array(
    'drinkki' => $uusidrinkki,
    'virhe' => "Anna nimi ja kuvaus",
    ));
    exit();
}

$muokattavanimi = $_POST["muokattavaNimi"];
$muokattavaValmistusohje = $_POST["muokattavaValmistusohje"];
$muokattavaLempinimet = $_POST["muokkattavaLempinimet"];
$muokattavaid = $_POST["id"];

$uusidrinkki->setNimi($muokattavanimi);
$uusidrinkki->setValmistusohje($muokattavaValmistusohje);
$uusidrinkki->setLempinimet($muokattavaLempinimet);
$uusidrinkki->setID($muokattavaid);

if ($uusidrinkki->onkoKelvollinenMuokattavaksi()) {
    $uusidrinkki->muokkaaDrinkkia();

    $_SESSION['ilmoitus'] = "drinkkiä muokattu onnistuneesti.";
    //drinkki lisättiin kantaan onnistuneesti, lähetetään käyttäjä eteenpäin

    header('Location: drinkkilistaus.php');
    //Asetetaan istuntoon ilmoitus siitä, että drinkki on lisätty.
} else {
    $virheet = $uusidrinkki->getVirheet();

    //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
    naytaNakyma("drinkinMuokkaus.php", array(
        'drinkki' => $uusidrinkki,
        'virhe' => $uusidrinkki->getVirheet()
    ));
}