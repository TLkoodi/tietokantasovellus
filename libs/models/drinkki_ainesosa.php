<?php

if (!function_exists('getTietokantayhteys')) {
    require 'tietokantayhteys.php';
}

// Tämä model toimii välitauluna SQL-tauluille ainesosa ja drinkki.

class Drinkki_ainesosa {

    private $ainesosaID;
    private $drinkkiID;
    private $virheet;

    public function __construct($ainesosaID, $drinkkiID) {
        $this->ainesosaID = $ainesosaID;
        $this->drinkkiID = $drinkkiID;
    }

    // Ensin hakee ne drinkit mihin aineosa kuuluu, hakemalla drinkkiID:t ainesosaID:n perusteella. 
    // Tämän jälkeen haetaan drinkkiIDn perusteella drinkit tiedot ja luodaan niistä ilmentymä, joka lisättään palautettavaan drinkkilistaan.

    public static function etsiDrinkitAinesosalla($haettuAinesosaID) {
        $sql = "SELECT drinkkiID, nimi, lempinimet, valmistusohje, muokattu, kayttajanimi FROM Drinkki A WHERE A.drinkkiID in (select B.drinkkiID from drinkki_ainesosa B where B.ainesosaID = ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haettuAinesosaID));

        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $drinkki = new Drinkki($tulos->nimi, $tulos->valmistusohje);
            $drinkki->setID($tulos->drinkkiID);
            $drinkki->setLempinimet($tulos->lempinimet);
            $drinkki->setMuokattu($tulos->muokattu);
            $drinkki->setKayttajanimi($tulos->kayttajanimi);

            $tulokset[] = $drinkki;
        }

        return $tulokset;
    }

    // Kuten ylläolevassa metodissa, mutta drinkin perusteella haetaan ainesosat.

    public static function etsiAinesosatDrinkissa($haettuDrinkkiID) {
        $sql = "SELECT ainesosaID, nimi, kuvaus FROM Ainesosa A WHERE A.ainesosaID in (SELECT B.ainesosaID from drinkki_ainesosa B WHERE B.drinkkiID = ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haettuDrinkkiID));

        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $ainesosa = new Ainesosa($tulos->nimi, $tulos->kuvaus);
            $ainesosa->setID($tulos->ainesosaID);
            $tulokset[] = $ainesosa;
        }

        return $tulokset;
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO Drinkki_ainesosa(drinkkiID, ainesosaID) VALUES(?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->drinkkiID, $this->ainesosaID));
        if ($ok) {
            $id = $kysely->fetchColumn();
        }
        return $ok;
    }

    // Tarkistetaan että tauluun lisättävät ID:t löytyvät Ainesosa ja Drinkki tauluista. Tämän jälkeen tarkistetaan ettei olemassaolevaa yhteyttä vielä ole.

    public function onkoKelvollinen() {

        $sql = "SELECT nimi FROM Ainesosa WHERE ainesosaID = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->ainesosaID));

        $tulos = $kysely->fetchObject();

        if ($tulos == null) {
            $this->virheet['ainesosaID'] = "Ainesosaa ei löytynyt.";
        } else {
            unset($this->virheet['ainesosaID']);
        }

        $sql2 = "SELECT nimi FROM Drinkki WHERE drinkkiID = ? LIMIT 1";
        $kysely2 = getTietokantayhteys()->prepare($sql2);
        $kysely2->execute(array($this->drinkkiID));

        $tulos2 = $kysely2->fetchObject();

        if ($tulos2 == null) {
            $this->virheet['drinkkiID'] = "Drinkkiä ei löytynyt.";
        } else {
            unset($this->virheet['drinkkiID']);
        }

        $sql3 = "SELECT drinkkiID, ainesosaID FROM Drinkki_ainesosa WHERE ainesosaID = ? AND drinkkiID = ? LIMIT 1";
        $kysely3 = getTietokantayhteys()->prepare($sql3);
        $kysely3->execute(array($this->ainesosaID, $this->drinkkiID));

        $tulos3 = $kysely3->fetchObject();

        if ($tulos3 != null) {
            $this->virheet['onJo'] = "Ainesosa on jo drinkissä";
        } else {
            unset($this->virheet['onJo']);
        }

        return empty($this->virheet);
    }

    public function getVirheet() {
        return $this->virheet;
    }

    public static function muutaAinesosanNimimuotoonID($ainesosanNimi) {
        $sql = "SELECT ainesosaid FROM Ainesosa WHERE nimi = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($ainesosanNimi));

        $tulos = $kysely->fetchObject();

        return $tulos->ainesosaid;
    }

}
