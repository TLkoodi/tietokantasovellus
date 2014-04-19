<!DOCTYPE HTML>
<html>
    <head>
        <link href="./css/bootstrap.css" rel="stylesheet">
        <link href="./css/bootstrap-theme.css" rel="stylesheet">
        <link href="./css/main.css" rel="stylesheet">
        <title>Kirjaudu drinkkitietokantaan</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">  
    </head>

    <?php
    /* HTML-rungon keskellä on sivun sisältö, 
     * joka haetaan sopivasta näkymätiedostosta.
     * Oikean näkymän tiedostonimi on tallennettu muuttujaan $sivu.
     */
    require 'views/' . $sivu;
    ?>

    <?php if (!empty($data->virhe)): ?>
        <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
    <?php endif; ?>
</html>
