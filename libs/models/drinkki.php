<?php
if (!function_exists('getTietokantayhteys')) {
    require 'tietokantayhteys.php';
}


class Drinkki {

    private $drinkkiID;
    private $nimi;
    private $lempinimet;
    private $valmistusohje;
    private $muokattu;
    private $kayttajanimi;
    private $virheet;

    public function __construct($nimi, $valmistusohje) {
        $this->nimi = $nimi;
        $this->valmistusohje = $valmistusohje;
    }

    public static function getDrinkitSivulla($sivu, $montako) {

        $sql = "SELECT drinkkiID, nimi, lempinimet, valmistusohje, muokattu, kayttajanimi FROM Drinkki LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($montako, ($sivu - 1) * $montako));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $drinkki = new Drinkki($tulos->nimi, $tulos->valmistusohje);
            $drinkki->setID($tulos->drinkkiID);
            $drinkki->setLempinimet($tulos->lempinimet);
            $drinkki->setMuokattu($tulos->muokattu);
            $drinkki->setKayttajanimi($tulos->kayttajanimi);
            
            $tulokset[] = $drinkki;
        }

        foreach ($tulokset as $drinkki) {
            echo $drinkki->drinkki;

            return $tulokset;
        }
    }

    public static function etsiDrinkki($haettuDrinkki) {
        $sql = "SELECT drinkkiID, nimi, lempinimet, valmistusohje, muokattu, kayttajanimi FROM Drinkki where nimi = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haettuDrinkki));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $drinkki = new Drinkki($tulos->nimi, $tulos->valmistusohje);
            $drinkki->setID($tulos->drinkkiID);
            $drinkki->setLempinimet($tulos->lempinimet);
            $drinkki->setMuokattu($tulos->muokattu);
            $drinkki->setKayttajanimi($tulos->kayttajanimi);
            return $drinkki;
        }
    }
    
    public static function etsiDrinkkiID($haettuID) {
        $sql = "SELECT drinkkiID, nimi, lempinimet, valmistusohje, muokattu, kayttajanimi FROM Drinkki where drinkkiID = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haettuID));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $drinkki = new Drinkki($tulos->nimi, $tulos->valmistusohje);
            $drinkki->setID($tulos->drinkkiID);
            $drinkki->setLempinimet($tulos->lempinimet);
            $drinkki->setMuokattu($tulos->muokattu);
            $drinkki->setKayttajanimi($tulos->kayttajanimi);
            return $drinkki;
        }
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO Drinkki(drinkkiID, nimi, lempinimet, valmistusohje, muokattu, kayttajanimi) VALUES(?,?,?,?,?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);



        $ok = $kysely->execute(array(Drinkki::isoinSerial(), $this->getNimi(), $this->getLempinimet(), $this->getValmistusohje(), $this->getMuokattu(), $this->getKayttajanimi()));
        if ($ok) {
            //Haetaan RETURNING-määreen palauttama id.
            //HUOM! Tämä toimii ainoastaan PostgreSQL-kannalla!
            $id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function muokkaaDrinkkia() {
        $sql = "UPDATE Drinkki SET nimi = ?, lempinimet = ?, valmistusohje = ?, muokattu = ?, kayttajanimi = ? WHERE drinkkiID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);



        $ok = $kysely->execute(array($this->getNimi(), $this->getLempinimet(), $this->getValmistusohje(), $this->getMuokattu(), $this->getKayttajanimi(), $this->getID()));
        if ($ok) {
            //Haetaan RETURNING-määreen palauttama id.
            $id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public static function poistaDrinkki($poistettavaID){
        $sql = "DELETE FROM Drinkki WHERE drinkkiID = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($poistettavaID));
    }

    public function setID($drinkkiID) {
        $this->drinkkiID = $drinkkiID;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }
    
    public function setLempinimet($lempinimet) {
        $this->lempinimet = $lempinimet;
    }

    public function setMuokattu($muokattu) {
        $this->muokattu = $muokattu;
    }

    public function setKayttajanimi($kayttajanimi) {
        $this->kayttajanimi = $kayttajanimi;
    }

    
    public function setValmistusohje($valmistusohje) {
        $this->valmistusohje = $valmistusohje;
    }

    public function getID() {
        $sql = "SELECT drinkkiID FROM Drinkki WHERE nimi = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->nimi));
        $numero = $kysely->fetchColumn();
        $this->drinkkiID = $numero;
        return $numero;
    }

    public function getNimi() {
        return $this->nimi;
    }
    public function getLempinimet() {
        return $this->lempinimet;
    }

    public function getMuokattu() {
        return $this->muokattu;
    }

    public function getKayttajanimi() {
        return $this->kayttajanimi;
    }    

    public function getValmistusohje() {
        return $this->valmistusohje;
    }

    public static function lukumaara() {
        $sql = "SELECT count(nimi) FROM Drinkki";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }

    public static function isoinSerial() {
        $sql = "SELECT MAX(drinkkiID) FROM Drinkki";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $numero = $kysely->fetchColumn();
        $numero++;
        return $numero;
    }

    public function onkoKelvollinen() {
        $loytyiko = Drinkki::etsiDrinkki($this->nimi);
        if ($loytyiko != null) {
            $this->virheet['nimi'] = "Samanniminen drinkki on jo listassa.";
        } else {
            unset($this->virheet['nimi']);
        }

        if (strlen($this->nimi) > 50) {
            $this->virheet['nimipituus'] = "Nimi on liian pitkä";
        } else {
            unset($this->virheet['nimipituus']);
        }
        if (strlen($this->valmistusohje) > 1000) {
            $this->virheet['valmistusohjepituus'] = "valmistusohje on liian pitkä";
        } else {
            unset($this->virheet['valmistusohje']);
        }
        
        return empty($this->virheet);
    }
    
    public function onkoKelvollinenMuokattavaksi() {
        if (strlen($this->nimi) > 50) {
            $this->virheet['nimipituus'] = "Nimi on liian pitkä";
        } else {
            unset($this->virheet['nimipituus']);
        }
        if (strlen($this->valmistusohje) > 1000) {
            $this->virheet['valmistusohjepituus'] = "valmistusohje on liian pitkä";
        } else {
            unset($this->virheet['valmistusohje']);
        }
        
        return empty($this->virheet);
    }
    
    public function getVirheet(){
        return $this->virheet;
    }
    
    

}