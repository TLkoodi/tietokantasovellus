<?php
session_start();
require 'libs/common.php';
require 'libs/models/drinkki_ainesosa.php';
require_once 'libs/models/drinkki.php';
require_once 'libs/models/ainesosa.php';

$drinkinid = $_GET['id'];
$piiloID = $_POST["id"];

if (empty($drinkinid)){
    $drinkinid=$piiloID;
}

if (empty($drinkinid)) {
   header('Location: drinkkilistaus.php');
}

$drinkki = drinkki::etsiDrinkkiID($drinkinid);
$nimi = $drinkki->getNimi();

$nakymannimi = "ainesosanLisaysDrinkkiin.php";

if (empty($_POST["lisattavaAinesosa"])) {
        /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
        naytaNakyma($nakymannimi, array(
            'nimi' => $nimi,
            'id' => $drinkinid,
            'virhe' => "Anna ainesosan nimi"
        ));
        exit();
    }
    
$ainesosannimi = $_POST["lisattavaAinesosa"];

$ainesosaIDalkuperainen = Drinkki_ainesosa::muutaAinesosanNimimuotoonID($ainesosannimi);

$kuvaus = $_POST["kuvaus"];

$luotavaAinesosa = new Ainesosa($ainesosannimi, $kuvaus);

if ($luotavaAinesosa->onkoKelvollinen()){
    $luotavaAinesosa->lisaaKantaan();
    
    $_SESSION['ilmoitus'] = "Ainesosa lisätty onnistuneesti tietokantaan.";
    
    $haettuAinesosa = Ainesosa::etsiAinesosa($ainesosannimi);
    
    $ainesosaIDalkuperainen = $haettuAinesosa->getID();
    
}

$drinkki_ainesosa = new Drinkki_ainesosa($ainesosaIDalkuperainen, $drinkinid);

if ($drinkki_ainesosa->onkoKelvollinen()){
    $drinkki_ainesosa->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Ainesosa on lisätty drinkkiin onnistuneesti.";
    naytaNakyma($nakymannimi, array(
            'nimi' => $nimi,
            'id' => $drinkinid,
        ));
}

naytaNakyma($nakymannimi, array(
    'nimi' => $nimi,
    'id' => $drinkinid,
            'virhe' => $drinkki_ainesosa->getVirheet()
        ));

