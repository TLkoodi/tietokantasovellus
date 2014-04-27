<?php
session_start();
require_once 'libs/models/kayttaja.php';
require 'libs/onkoAdmin.php';

Kayttaja::poistaKayttaja($_GET['id']);

$_SESSION['ilmoitus'] = "Käyttäjä poistettu";

header('Location: kayttajalistaus.php');
