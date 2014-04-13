<?php
session_start();
require 'libs/common.php';
require 'libs/models/drinkki.php';

$id = $_GET['id'];

$drinkki = Drinkki::etsiDrinkki($id);

if ($drinkki != null) {
  naytaNakyma("drinkkiTietosivu.php", array(
    'nimi' => $id,
    'valmistusohje' => $drinkki->getValmistusohje(),
      'id'=> $drinkki->getID()
  ));
} else {
  naytaNakyma("drinkkiTietosivu.php", array(
    'drinkki' => null,
    'virhe' => 'Ainesosaa ei löytynyt!'
  ));
}