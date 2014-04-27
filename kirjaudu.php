<?php
session_start();

require_once 'libs/kirjautumisCommon.php';
require_once 'libs/models/kayttaja.php';

$kayttaja = $_POST["username"];
$salasana = $_POST["password"];

if (empty($_POST["username"]) || empty($_POST["password"])) {
    naytaNakyma("login.php", array(
        'kayttaja' => $kayttaja,
        'virhe' => "Anna käyttäjätunnus ja salasana.",
    ));
    exit();
}



$haettuKayttaja = Kayttaja::etsiKayttajaTunnuksilla($kayttaja, $salasana);



//    var_dump($haettuKayttaja);
//    if ($haettuKayttaja != null) {
//        //Tallennetaan istuntoon käyttäjäolio
//        $_SESSION['kirjautunut'] = $haettuKayttajakayttaja;
//    }

if ($haettuKayttaja == null) {
    naytaNakyma("login.php", array(
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.",
    ));
}

/* Tarkistetaan onko parametrina saatu oikeat tunnukset */
if ($haettuKayttaja->getNimi() == $kayttaja && $haettuKayttaja->getSalasana() == $salasana) {
    $_SESSION['kayttaja'] = $haettuKayttaja->getNimi();
    //   if ("1" == $kayttaja1 && "1" == $salasana1) {
    /* Jos tunnus on oikea, ohjataan käyttäjä sopivalla HTTP-otsakkeella kissalistaan. */
    $_SESSION['kayttajataso'] = $haettuKayttaja->getKayttajataso();
    header('Location: drinkkilistaus.php');
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen. */
    naytaNakyma("login.php", array(
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.",
    ));
}
?>
