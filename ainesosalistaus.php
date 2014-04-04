<?php
require 'libs/common.php';
require 'libs/models/ainesosa.php';

$sivu = 1;
if (isset($_GET['sivu'])) {
    $sivu = (int) $_GET['sivu'];

    //Sivunumero ei saa olla pienempi kuin yksi
    if ($sivu < 1)
        $sivu = 1;
}
$montakoainesosaa = 10;

$ainesosat= ainesosa::getAinesosatSivulla($sivu, $montakoainesosaa);

$AinesosaLkm=Ainesosa::lukumaara();
$sivuja = ceil($AinesosaLkm / $montakoainesosaa);
$serial=Ainesosa::isoinSerial();
        
?>

<?php
naytaNakyma('ainesosalista.php', array(
    'ainesosat' => $ainesosat, 'sivu' => $sivu, 'AinesosaLkm' => $AinesosaLkm, 'sivuja' => $sivuja, 'serial' => $serial));
?>