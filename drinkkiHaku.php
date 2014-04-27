<?php
session_start();
require 'libs/common.php';
require 'libs/models/drinkki.php';

$hakusana = $_POST['hakusana'];
$taso = $_SESSION['kayttajataso'];

$drinkit= Drinkki::etsiDrinkit($hakusana);


naytaNakyma('drinkkilista.php', array(
    'drinkit' => $drinkit, 'taso' => $taso));
?>

