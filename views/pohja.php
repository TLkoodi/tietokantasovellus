<!DOCTYPE HTML>
<html>
    <nav>
        <a href="./drinkit.html">Drinkit</a>
        <a href="./ainesosat.html">Ainesosat</a>
        <a href="./demo.html">Kirjaudu ulos</a>
    </nav>
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
