<?php
//Tarkistetaan onko käyttäjä tasolla 1.
//Tätä luokkaa käytetään sivuilla joiden operaatiot on varattu vain ylimmän tason käyttäjille.

if ($_SESSION['kayttajataso'] != 1){
    $_SESSION['ilmoitus'] = "Käyttäjätasosi ei riitä operaatioon.";
    header('Location: drinkkilistaus.php');
}