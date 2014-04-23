<?php
if (!function_exists('getTietokantayhteys')) {
    require 'tietokantayhteys.php';
}

class Kayttaja {

    private $kayttajanimi;
    private $sahkoposti;
    private $salasana;
    private $kayttajataso;
    private $luotu;
    private $virheet;

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

    public static function etsiKayttajaTunnuksilla($haettuKayttaja, $haettuSalasana) {
        $sql = "SELECT kayttajanimi, salasana FROM Kayttaja where kayttajanimi = ? AND salasana = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haettuKayttaja, $haettuSalasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja();
            $kayttaja->setKayttajanimi($tulos->kayttajanimi);
            $kayttaja->setSalasana($tulos->salasana);

            return $kayttaja;
        }
    }

    public static function etsiKayttajanimi($haettuKayttaja) {
        $sql = "SELECT kayttajanimi FROM Kayttaja where kayttajanimi = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haettuKayttaja));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            return $tulos;
        }
    }

    public static function etsiKaikkiKayttajat() {
        $sql = "SELECT kayttajanimi, sahkoposti, salasana, kayttajataso, luotu FROM Kayttaja";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja();
            $kayttaja->setKayttajanimi($tulos->kayttajanimi);
            $kayttaja->setSahkoposti($tulos->sahkoposti);
//            $kayttaja->setSalanana($tulos->salasana);
//            $kayttaja->setKayttajataso($tulos->kayttajataso);
//            $kayttaja->setLuotu($tulos->luotu);
            //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
            //Se vastaa melko suoraan ArrayList:in add-metodia.
            $tulokset[] = $kayttaja;
        }

        echo $tulokset;
        foreach ($tulokset as $kayttajanimi) {
            echo $kayttajanimi->kayttajanimi;

            return $tulokset;
        }
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO Kayttaja(kayttajanimi, sahkoposti, salasana, kayttajataso, luotu) VALUES(?,?,?,'2','1999-01-08')";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->kayttajanimi, $this->sahkoposti, $this->salasana
        ));
        if ($ok) {
            //Haetaan RETURNING-määreen palauttama id.
            //HUOM! Tämä toimii ainoastaan PostgreSQL-kannalla!
            $id = $kysely->fetchColumn();
        }
        return $ok;
    }

    public function onkoKelvollinen() {
        if (strlen($this->kayttajanimi) > 30) {
            $this->virheet['nimipituus'] = "Nimi on liian pitkä";
        } else {
            unset($this->virheet['nimipituus']);
        }
        if (strlen($this->salasana) > 30) {
            $this->virheet['salasana'] = "salasana on liian pitkä";
        } else {
            unset($this->virheet['salasana']);
        }

        return empty($this->virheet);
    }

    public function setKayttajanimi($kayttajanimi) {
        $this->kayttajanimi = $kayttajanimi;
    }

    public function setSahkoposti($sahkoposti) {
        $this->sahkoposti = $sahkoposti;
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
    }

    public function getNimi() {
        return $this->kayttajanimi;
    }

    public function getSahkoposti() {
        return $this->sahkoposti;
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function getVirheet() {
        return $this->virheet;
    }

    public function getKayttajataso() {
        return $this->kayttajataso;
    }

    public function getLuotu() {
        return $this->luotu;
    }

    public function setKayttajataso($kayttajataso) {
        $this->kayttajataso = $kayttajataso;
    }

    public function setLuotu($luotu) {
        $this->luotu = $luotu;
    }

}

?>