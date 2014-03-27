<?php

//
//require_once "tietokantayhteys.php";
require_once "models/kayttaja.php";
?>
<?php

class listaustesti {

    public function __construct() {

//        echo "Hei maailma!", "Hei ", $nimi;
//
//        $listaus = array();
//
//        $listaus->etsiKaikkiKayttajat();
//
//
//        foreach ($listaus as $kayttaja) {
//            echo $kayttaja->getNimi();
//            echo $kayttaja->getSahkoposti();
//        }
    }

}
?>
<?php


$listaus = Kayttaja::etsiKaikkiKayttajat();
foreach ($listaus as $kayttaja) {
            var_dump($kayttaja);
        }
?>