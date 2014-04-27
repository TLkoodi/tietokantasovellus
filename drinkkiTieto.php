<?php
session_start();
require 'libs/common.php';
require_once 'libs/models/drinkki.php';
require_once 'libs/models/drinkki_ainesosa.php';
require_once 'libs/models/ainesosa.php';

$taso = $_SESSION['kayttajataso'];

$drinkinNimi = $_GET['id'];

$drinkki = Drinkki::etsiDrinkki($drinkinNimi);

$ainesosat = Drinkki_ainesosa::etsiAinesosatDrinkissa($drinkki->getID());

if ($drinkki != null) {
    naytaNakyma("drinkkiTietosivu.php", array(
        'nimi' => $drinkinNimi,
        'valmistusohje' => $drinkki->getValmistusohje(),
        'lempinimet' => $drinkki->getLempinimet(),
        'ainesosat' => $ainesosat,
        'id' => $drinkki->getID(),      
        'taso' => $taso
    ));
} else {
    naytaNakyma("drinkkiTietosivu.php", array(
        'drinkki' => null,
        'virhe' => 'Ainesosaa ei löytynyt!'
    ));
}