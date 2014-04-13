<?php
require 'libs/common.php';
require 'libs/models/drinkki.php';

$sivu = 1;
if (isset($_GET['sivu'])) {
    $sivu = (int) $_GET['sivu'];

    //Sivunumero ei saa olla pienempi kuin yksi
    if ($sivu < 1)
        $sivu = 1;
}
$montakodrinkkia = 10;

$drinkit= Drinkki::getDrinkitSivulla($sivu, $montakodrinkkia);

$DrinkkiLkm=Drinkki::lukumaara();
$sivuja = ceil($DrinkkiLkm / $montakodrinkkia);
$serial=Drinkki::isoinSerial();
        
?>

<?php
naytaNakyma('drinkkilista.php', array(
    'drinkit' => $drinkit, 'sivu' => $sivu, 'DrinkkiLkm' => $DrinkkiLkm, 'sivuja' => $sivuja, 'serial' => $serial));
?>
