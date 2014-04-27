<?php
session_start();
require 'libs/common.php';
require 'libs/models/ainesosa.php';
require 'libs/onkoAdmin.php';


$id = $_GET['id'];

Ainesosa::poistaAinesosa($id);

$_SESSION['ilmoitus'] = "Ainesosa poistettu.";
    //Ainesosa poistettiin onnistuneesti, lähetetään käyttäjä eteenpäin
    
    header('Location: ainesosalistaus.php');