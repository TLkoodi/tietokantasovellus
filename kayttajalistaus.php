<?php
require 'libs/common.php';
require 'libs/onkoAdmin.php';
require_once 'libs/models/kayttaja.php';



$kayttajat = Kayttaja::etsiKaikkiKayttajat();

naytaNakyma('kayttajalista.php', array(
    'kayttajat' => $kayttajat));
?>
