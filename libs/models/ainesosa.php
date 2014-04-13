<?php

require 'tietokantayhteys.php';

class Ainesosa {

    private $ainesosaID;
    private $nimi;
    private $kuvaus;
    private $virheet;

    public function __construct($nimi, $kuvaus) {
        $this->nimi = $nimi;
        $this->kuvaus = $kuvaus;
    }

    public static function getAinesosatSivulla($sivu, $montako) {

        $sql = "SELECT ainesosaID, nimi, kuvaus FROM Ainesosa LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($montako, ($sivu - 1) * $montako));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $ainesosa = new Ainesosa($tulos->nimi, $tulos->kuvaus);
            $ainesosa->setID($tulos->ainesosaID);

            $tulokset[] = $ainesosa;
        }

        foreach ($tulokset as $ainesosa) {
            echo $ainesosa->ainesosa;

            return $tulokset;
        }
    }

    public static function etsiAinesosa($haettuAinesosa) {
        $sql = "SELECT ainesosaID, nimi, kuvaus FROM Ainesosa where nimi = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haettuAinesosa));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $ainesosa = new Ainesosa($tulos->nimi, $tulos->kuvaus);
 //           $ainesosa->setID($tulos->ainesosaID);
            return $ainesosa;
        }
    }
    
    public static function etsiAinesosaID($haettuID) {
        $sql = "SELECT ainesosaID, nimi, kuvaus FROM Ainesosa where ainesosaID = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haettuID));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $ainesosa = new Ainesosa($tulos->nimi, $tulos->kuvaus);
            $ainesosa->setID($tulos->ainesosaID);
            
            return $ainesosa;
        }
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO Ainesosa(ainesosaID, nimi, kuvaus) VALUES(?,?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);



        $ok = $kysely->execute(array(Ainesosa::isoinSerial(), $this->getNimi(), $this->getKuvaus()));
        if ($ok) {
            //Haetaan RETURNING-määreen palauttama id.
            //HUOM! Tämä toimii ainoastaan PostgreSQL-kannalla!
            $id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function muokkaaAinesosaa() {
        $sql = "UPDATE Ainesosa SET nimi = ?, kuvaus = ? WHERE ainesosaID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);



        $ok = $kysely->execute(array($this->getNimi(), $this->getKuvaus(), $this->getID()));
        if ($ok) {
            //Haetaan RETURNING-määreen palauttama id.
            //HUOM! Tämä toimii ainoastaan PostgreSQL-kannalla!
            $id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public static function poistaAinesosa($poistettavaID){
        $sql = "DELETE FROM Ainesosa WHERE ainesosaID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($poistettavaID));
    }

    public function setID($aineosaid) {
  //      $this->ainesosaID = $ainesosaid;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function setKuvaus($kuvaus) {
        $this->kuvaus = $kuvaus;
    }

    public function getID() {
        $sql = "SELECT ainesosaID FROM Ainesosa WHERE nimi = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->nimi));
        $numero = $kysely->fetchColumn();
        $this->ainesosaID = $numero;
        return $numero;
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

    public function onkoKelvollinen() {
        $loytyiko = Ainesosa::etsiAinesosa($this->nimi);
        if ($loytyiko != null) {
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
    
    public function onkoKelvollinenMuokattavaksi() {
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
    
    public function getVirheet(){
        return $this->virheet;
    }
    
    

}
