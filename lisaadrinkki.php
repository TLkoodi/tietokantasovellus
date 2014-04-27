<?php

session_start();
require 'libs/common.php';
require 'libs/onkoAdmin.php';
require 'libs/models/drinkki.php';
require_once 'libs/models/kayttaja.php';

$nimi = $_POST["nimi"];
$valmistusohje = $_POST["valmistusohje"];
$lempinimet = $_POST["lempinimet"];

if (empty($_POST["nimi"]) || empty($_POST["valmistusohje"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("drinkkilomake.php", array(
        'drinkki' => $nimi,
        'valmistusohje' => $valmistusohje,
        'lempinimet' => $lempinimet,
        'virhe' => "Anna nimi ja valmistusohje"
    ));
    exit();
}

$uusidrinkki = new Drinkki($nimi, $valmistusohje);
$uusidrinkki->setKayttajanimi($_SESSION['kayttaja']);
$uusidrinkki->setLempinimet($lempinimet);

if ($uusidrinkki->onkoKelvollinen()) {
    $uusidrinkki->lisaaKantaan();

    $_SESSION['ilmoitus'] = "Drinkki lisätty onnistuneesti. Lisää drinkkiin vielä ainesosat.";

    $lahtettavadrinkki = Drinkki::etsiDrinkki($nimi);
    $muokattavaid = $lahtettavadrinkki->getID();
    //lisättiin kantaan onnistuneesti, lähetetään käyttäjä eteenpäin
    naytaNakyma("ainesosanLisaysDrinkkiin.php", array(
        'nimi' => $nimi,
        'id' => $muokattavaid,
    ));
} else {
    $virheet = $uusidrinkki->getVirheet();

    //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
    naytaNakyma("drinkkilomake.php", array(
        'drinkki' => $nimi,
        'valmistusohje' => $valmistusohje,
        'lempinimet' => $lempinimet,
        'virhe' => $uusidrinkki->getVirheet()
    ));
}
