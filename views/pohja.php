<!DOCTYPE HTML>
<html>

    <link rel="stylesheet" href="./css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css">

    <?php
    /* HTML-rungon keskellä on sivun sisältö, 
     * joka haetaan sopivasta näkymätiedostosta.
     * Oikean näkymän tiedostonimi on tallennettu muuttujaan $sivu.
     */
    require 'views/navigointipalkki.php';
    require 'views/' . $sivu;
    ?>

    <?php if (!empty($data->virhe)): ?>
        <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
    <?php endif; ?>
</html>
