<!DOCTYPE HTML>
<html>

    <link rel="stylesheet" href="./css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css">

    <head>
        <title>DRINKKITIETOKANTA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>

    <?php
    /* HTML-rungon keskellä on sivun sisältö, 
     * joka haetaan sopivasta näkymätiedostosta.
     * Oikean näkymän tiedostonimi on tallennettu muuttujaan $sivu.
     */
    require 'views/navigointipalkki.php';
    require 'views/' . $sivu;
    ?>

    <?php if (!empty($_SESSION['ilmoitus'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['ilmoitus']; ?>
        </div>
        <?php
        // Samalla kun viesti näytetään, se poistetaan istunnosta,
        // ettei se näkyisi myöhemmin jollain toisella sivulla uudestaan.
        unset($_SESSION['ilmoitus']);
    endif;
    ?>

    <?php if (!empty($data->virhe)) { 
        if (is_array($data->virhe)) {
            foreach ($data->virhe as $virhe):
                ?>
                <div class="alert alert-danger"><?php echo $virhe; ?></div>
                <?php
            endforeach;
            unset($data->virhe);
        } else {
            ?>
            <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
            <?php
        }
    }
    ?>

</html>
