<?php
session_start();
require_once 'libs/models/kayttaja.php';

$kayttajanNimi = $_GET['id'];

$kayttaja = Kayttaja::etsiKayttajanimi($kayttajanNimi);

$kayttajanTaso = $kayttaja->getKayttajataso();

if ($kayttajanTaso == 2){
    $kayttaja->setKayttajataso(1);
    Kayttaja::poistaKayttaja($_GET['id']);
    $kayttaja->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Käyttäjä ylennetty ylläpitäjäksi.";
} else {
    $kayttaja->setKayttajataso(2);
    Kayttaja::poistaKayttaja($_GET['id']);
    $kayttaja->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Käyttäjän ylläpito-oikeudet poistettu.";
}



header('Location: kayttajalistaus.php');
