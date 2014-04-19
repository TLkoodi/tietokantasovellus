<?php
session_start();
require 'libs/common.php';
require 'libs/models/drinkki_ainesosa.php';
require_once 'libs/models/drinkki.php';

$id = $_GET['id'];
$piiloID = $_POST["id"];

if (empty($id)){
    $id=$piiloID;
}

if (empty($id)) {
   header('Location: drinkkilistaus.php');
}

$drinkki = drinkki::etsiDrinkkiID($id);
$nimi = $drinkki->getNimi();

$nakymannimi = "ainesosanLisaysDrinkkiin.php";

if (empty($_POST["lisattavaAinesosa"])) {
        /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
        naytaNakyma($nakymannimi, array(
            'nimi' => $nimi,
            'id' => $id,
            'virhe' => "Anna ainesosan nimi"
        ));
        exit();
    }
    
$ainesosannimi = $_POST["lisattavaAinesosa"];

$ainesosaIDalkuperainen = Drinkki_ainesosa::muutaAinesosanNimimuotoonID($ainesosannimi);

$drinkki_ainesosa = new Drinkki_ainesosa($ainesosaIDalkuperainen, $id);

if ($drinkki_ainesosa->onkoKelvollinen()){
    $drinkki_ainesosa->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Ainesosa on lisätty drinkkiin onnistuneesti.";
    naytaNakyma($nakymannimi, array(
            'nimi' => $nimi,
            'id' => $id,
        ));
}

naytaNakyma($nakymannimi, array(
    'nimi' => $nimi,
    'id' => $id,
            'virhe' => $drinkki_ainesosa->getVirheet()
        ));

