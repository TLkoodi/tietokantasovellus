<?php
session_start();
require_once 'libs/models/kayttaja.php';

$kirjautunutKayttaja = new Kayttaja();

 if (isset($_SESSION['kayttaja'])) {
    $kirjautunutKayttaja = $_SESSION['kayttaja'];
  }

    function naytaNakyma($sivu, $data = array()) {
        $data = (object) $data;
        require 'views/pohja.php';

        exit();
    }