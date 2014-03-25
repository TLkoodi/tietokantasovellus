<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

    <?php
    require_once "kirjastot/tietokantayhteys.php";
    require_once "kirjastot/kayttaja.php";
    foreach ($lista as $asia):
        ?>
    <li><?php echo $asia; ?></li>
<?php endforeach; ?>

</body>
</html>
