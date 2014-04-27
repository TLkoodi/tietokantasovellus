<?php
session_start();
require 'libs/common.php';
require 'libs/models/drinkki.php';
require 'libs/onkoAdmin.php';

$id = $_GET['id'];

Drinkki::poistaDrinkki($id);

$_SESSION['ilmoitus'] = "Drinkki poistettu.";
    // poistettiin onnistuneesti, lähetetään käyttäjä eteenpäin
    
    header('Location: drinkkilistaus.php');