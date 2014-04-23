<?php
session_start();
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if (empty($_POST["username"]) || empty($_POST["password"])) {
    naytaNakyma("rekisteroitymisSivu.php", array(
        'virhe' => "Anna toivottu kaytaajanimi ja salasana",
    ));
    exit();
}

$kayttaja = $_POST["username"];
$salasana = $_POST["password"];
$sahkoposti = $_POST["email"];

$onkoOlemassa = Kayttaja::etsiKayttajanimi($kayttaja);

if (!empty($onkoOlemassa)) {
    naytaNakyma("rekisteroitymisSivu.php", array(
        'virhe' => "Käyttäjänimi on jo olemassa",
    ));
}

$uusikayttaja = new Kayttaja($kayttaja, $sahkoposti, $salasana, 2, 1);

if ($uusikayttaja->onkoKelvollinen()) {
    $uusikayttaja->lisaaKantaan();
    //lisättiin kantaan onnistuneesti, lähetetään käyttäjä eteenpäin
    header('Location: kirjaudu.php');
} else {
    $virheet = $uusikayttaja->getVirheet();

    //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
    naytaNakyma("rekisteroitymisSivu.php", array(
        'nimi' => $kayttaja,
        'virhe' => $uusidrinkki->getVirheet()
    ));
}
