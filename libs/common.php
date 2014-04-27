<?php
session_start();
require_once 'libs/models/kayttaja.php';

if (!isset($_SESSION['kayttaja'])) {
    header('Location: uloskirjautuminen.php');
}

$kirjautunutKayttaja = $_SESSION['kayttaja'];

//$nimi = $kirjautunutKayttaja->getNimi();
$loytyykoKayttaja = Kayttaja::etsiKayttajanimi($kirjautunutKayttaja);

if ($loytyykoKayttaja == null) {
    header('Location: uloskirjautuminen.php');
}

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/pohja.php';

    exit();
}
