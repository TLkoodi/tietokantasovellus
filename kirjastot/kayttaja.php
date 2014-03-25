<?php

require 'kirjastot/tietokantayhteys.php';


class Kayttaja {

    private $kayttajanimi;
    private $sahkoposti;
    private $salasana;
    private $kayttajataso;
    private $luotu;
    

    public function __construct($kayttajanimi, $sahkoposti, $salasana, $kayttajataso, $luotu) {
        $this->kayttajanimi = $kayttajanimi;
        $this->sahkoposti = $sahkoposti;
        $this->salasana = $salasana;
        $this->kayttajataso = $kayttajataso;
        $this->luotu = $luotu;
    }

    /* Tähän gettereitä ja settereitä */

    function hae() {
        $yhteys = getTietokantayhteys();
    }

    public static function etsiKaikkiKayttajat() {
        $sql = "SELECT kayttajanimi, sahkoposti, salasana, kayttajataso, luotu FROM users";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setKayttajanimi($tulos->kayttajanimi);
            $kayttaja->setSahkoposti($tulos->sahkoposti);
            $kayttaja->setSalanana($tulos->salasana);
            $kayttaja->setKayttajataso($tulos->kayttajataso);
            $kayttaja->setLuotu($tulos->luotu);

            //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
            //Se vastaa melko suoraan ArrayList:in add-metodia.
            $tulokset[] = $kayttaja;
        }
        
        echo $tulokset;
        foreach ($tulokset as $kayttajanimi) {
        echo $kayttajanimi->kayttajanimi;
        
        return $tulokset;
    }

}}
