    <?php
    session_start();
  //  unset($_SESSION['kirjautunut']);

    require_once 'libs/kirjautumisCommon.php';
    require_once 'libs/models/kayttaja.php';
//    require 'uloskirjautuminen.php';

    if (empty($_POST["username"]) || empty($_POST["password"])) {
        naytaNakyma("login.php", array(
        ));
        exit();
    }

    $kayttaja = $_POST["username"];
    $salasana = $_POST["password"];

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
        $_SESSION['kayttaja'] = $haettuKayttaja;
        //   if ("1" == $kayttaja1 && "1" == $salasana1) {
        /* Jos tunnus on oikea, ohjataan käyttäjä sopivalla HTTP-otsakkeella kissalistaan. */
        header('Location: drinkkilistaus.php');
    } else {
        /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen. */
        naytaNakyma("login.php", array(
            'kayttaja' => $kayttaja,
            'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.",
        ));
    }
    ?>
