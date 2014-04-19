<?php

session_start();
require 'libs/common.php';
require_once 'libs/models/ainesosa.php';
require_once 'libs/models/drinkki_ainesosa.php';
require_once 'libs/models/drinkki.php';

$ainesosanNimi = $_GET['id'];

$ainesosa = Ainesosa::etsiAinesosa($ainesosanNimi);

$drinkit = Drinkki_ainesosa::etsiDrinkitAinesosalla($ainesosa->getID());

if ($ainesosa != null) {
    naytaNakyma("ainesosaTietosivu.php", array(
        'nimi' => $ainesosanNimi,
        'kuvaus' => $ainesosa->getKuvaus(),
        'drinkit' => $drinkit,
        'id' => $ainesosa->getID()
    ));
} else {
    naytaNakyma("ainesosaTietosivu.php", array(
        'ainesosa' => null,
        'virhe' => 'Ainesosaa ei löytynyt!'
    ));
}