<?php

/* Näyttää näkymätiedoston ja lähettää sille muuttujat */

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;  
    require 'views/pohja.php';
    exit();

//    function kirjautuminen() {
//        if (empty($_POST["username"]) || empty($_POST["password"])) {
//            /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
//            naytaNakyma("login");
//            exit(); // Lopetetaan suoritus tähän. Kutsun voi sijoittaa myös naytaNakyma-funktioon, niin sitä ei tarvitse toistaa joka paikassa
//        }
//
//        $kayttaja = $_POST["username"];
//        $salasana = $_POST["password"];
//
//        /* Tarkistetaan onko parametrina saatu oikeat tunnukset */
//        if ("1" == $kayttaja && "1" == $salasana) {
//            /* Jos tunnus on oikea, ohjataan käyttäjä sopivalla HTTP-otsakkeella kissalistaan. */
//            header('Location: drinkkilista.php');
//        } else {
//            /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen. */
//            naytaNakyma("login");
//        }
//    }

}
