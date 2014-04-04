<?php

require 'libs/common.php';
require 'libs/models/ainesosa.php';

if (empty($_POST["nimi"]) || empty($_POST["kuvaus"])) {
        /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
        naytaNakyma("ainesosalomake.php", array(
            'virhe' => "Anna nimi ja kuvaus",
        ));
        exit();
    }

$nimi = $_POST["nimi"];
$kuvaus = $_POST["kuvaus"];

$uusiainesosa = new Ainesosa();
$uusiainesosa->setNimi($nimi);
$uusiainesosa->setKuvaus($kuvaus);

if ($uusiainesosa->onkoKelvollinen()) {
  $uusiainesosa->lisaaKantaan();
  
  //Kissa lisättiin kantaan onnistuneesti, lähetetään käyttäjä eteenpäin
  header('Location: ainesosalistaus.php');
  //Asetetaan istuntoon ilmoitus siitä, että kissa on lisätty.
  //Tästä tekniikasta kerrotaan lisää kohta
  $_SESSION['ilmoitus'] = "Ainesosa lisätty onnistuneesti.";

} else {
  $virheet = $uusiainesosa->getVirheet();

  //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
  naytaNakyma("ainesosalomake", array(
    'ainesosa' => $nimi,
      'kuvaus' => $kuvaus,
    'virheet' => $uusiainesosa->getVirheet()
  ));
}