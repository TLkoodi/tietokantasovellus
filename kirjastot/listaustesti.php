<?php

require_once "kirjastot/tietokantayhteys.php";
require_once "kirjastot/kayttaja.php";

class listaustesti {

    

    public function __construct() {
        
        
        $listaus->etsiKaikkiKayttajat();
        
        
        var_dump($listaus);
        var_dump("ddd");
        
        echo "Hei maailma!", "Hei ", $nimi;
        
        
      //  foreach ($listaus as $kayttajanimi) {
        //    var_dump($kayttajanimi->kayttajanimi);
        }
    }

//}
