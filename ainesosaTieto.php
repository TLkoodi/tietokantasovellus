<?php
session_start();
require 'libs/common.php';
require 'libs/models/ainesosa.php';

$id = $_GET['id'];

$ainesosa = Ainesosa::etsiAinesosa($id);

if ($ainesosa != null) {
  naytaNakyma("ainesosaTietosivu.php", array(
    'nimi' => $id,
    'kuvaus' => $ainesosa->getKuvaus(),
      'id'=> $ainesosa->getID()
  ));
} else {
  naytaNakyma("ainesosaTietosivu.php", array(
    'ainesosa' => null,
    'virhe' => 'Ainesosaa ei löytynyt!'
  ));
}