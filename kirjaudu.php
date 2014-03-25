<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
    require 'libs/common.php';
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
        naytaNakymä("login.php", array(
      'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
       ));
    }

    $kayttaja = $_POST["username"];
    $salasana = $_POST["password"];

    /* Tarkistetaan onko parametrina saatu oikeat tunnukset */
    if ("1" == $kayttaja && "1" == $salasana) {
        /* Jos tunnus on oikea, ohjataan käyttäjä sopivalla HTTP-otsakkeella kissalistaan. */
        header('Location: drinkkilista.php');
    } else {
        /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen. */
        naytaNakyma('login.php', array(
            'kayttaja' => $kayttaja,
            'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.", request
        ));
    }
    ?>
</body>
</html>
