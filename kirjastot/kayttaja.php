<?php

class Kayttaja {

    private $id;
    private $tunnus;
    private $password;

    public static function hae() {
        require 'kirjastot/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare("SELECT 1");
        $kysely->execute();

        echo $kysely->fetchColumn();
        $yhteys = getTietokantayhteys();
    }

    public function __construct($id, $tunnus, $salasana) {
        $this->id = $id;
        $this->tunnus = $tunnus;
        $this->salasana = $salasana;
    }

    /* Tähän gettereitä ja settereitä */
}
