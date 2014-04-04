<?php

session_start();

//if (!isset($_SESSION['kirjautunut'])) {
//    naytaNakyma("login.php", array(
//        'virhe' => "Kirjautumista ei ole olemassa",
//    ));
//    exit();
//}

    function naytaNakyma($sivu, $data = array()) {
        $data = (object) $data;
        require 'views/pohja.php';

        exit();
    }