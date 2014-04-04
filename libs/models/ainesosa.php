<?php

require 'tietokantayhteys.php';

class Ainesosa {

    private $ainesosaid;
    private $nimi;
    private $kuvaus;
    private $virheet;

    public function __construct($ainesosaid, $nimi, $kuvaus) {
        $this->ainesosaid = $ainesosaid;
        $this->nimi = $nimi;
        $this->kuvaus = $kuvaus;
    }

    public static function getAinesosatSivulla($sivu, $montako) {

        $sql = "SELECT ainesosaID, nimi, kuvaus FROM Ainesosa LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($montako, ($sivu - 1) * $montako));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $ainesosa = new Ainesosa();
            $ainesosa->setID($tulos->ainesosaid);
            $ainesosa->setNimi($tulos->nimi);
            $ainesosa->setKuvaus($tulos->kuvaus);

            $tulokset[] = $ainesosa;
        }

        foreach ($tulokset as $ainesosa) {
            echo $ainesosa->ainesosa;

            return $tulokset;
        }
    }

    public static function etsiAinesosa($haettuAinesosa) {
        $sql = "SELECT nimi FROM Ainesosa where nimi = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haettuNimi));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $ainesosa = new Ainesosa();
            $ainesosa->setID($tulos->ainesosaid);

            return $ainesosa;
        }
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO Aineosa(ainesosaID, nimi, kuvaus) VALUES(?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);



        $ok = $kysely->execute(array(isoinSerial(), $this->getNimi(), $this->getKuvaus()));
        if ($ok) {
            //Haetaan RETURNING-määreen palauttama id.
            //HUOM! Tämä toimii ainoastaan PostgreSQL-kannalla!
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }

    public function setID($aineosaid) {
        $this->ainesosaid = $ainesosaid;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function setKuvaus($kuvaus) {
        $this->kuvaus = $kuvaus;
    }

    public function getID() {
        return $this->ainesosaid;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getKuvaus() {
        return $this->kuvaus;
    }

    public static function lukumaara() {
        $sql = "SELECT count(nimi) FROM Ainesosa";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }

    public static function isoinSerial() {
        $sql = "SELECT MAX(ainesosaID) FROM Ainesosa";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $numero = $kysely->fetchColumn();
        $numero++;
        return $numero;
    }

    public static function onkoKelvollinen() {
        if (!etsiAinesosa($this->nimi) == null) {
            $this->virheet['nimi'] = "Samanniminen ainesosa on jo listassa.";
        } else {
            unset($this->virheet['nimi']);
        }

        if (strlen($this->nimi) > 30) {
            $this->virheet['nimipituus'] = "Nimi on liian pitkä";
        } else {
            unset($this->virheet['nimipituus']);
        }
        if (strlen($this->kuvaus) > 100) {
            $this->virheet['kuvauspituus'] = "Kuvaus on liian pitkä";
        } else {
            unset($this->virheet['kuvaus']);
        }
        
        return empty($this->virheet);
    }
    
    public static function getVirheet(){
        return $this->virheet;
    }
    
    

}
