<!DOCTYPE html>
<head>
    <title>Drinkit</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
</head>
<body>
    <h1>Drinkit</h1>

    <div class="ainesosa">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Drinkin nimi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->drinkit as $drinkki): ?>
                    <tr>
                        <td>
                            <a href="drinkkiTieto.php?id=<?php echo  htmlspecialchars($drinkki->getNimi()) ?>"><?php echo htmlspecialchars($drinkki->getNimi()) ?></a>
                        </td>
                        <td>                 
                            <form action="./muokkaaDrinkkia.php?id=<?php echo htmlspecialchars($drinkki->getNimi()) ?>" method="POST">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn btn-default">Muokkaa drinkkiä</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form action="./poistaDrinkki.php?id=<?php echo htmlspecialchars($drinkki->getID()) ?>" method="POST">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn btn-default">Poista drinkki</button>
                                </div>

                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                    <td>
                        <form action="lisaadrinkki.php" method="POST">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-default">Lisää drinkki</button>
                            </div>

                        </form></td><td><td></td></td></tr>
            </tbody>
        </table>
    </div>

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

    <?php if ($data->sivu > 1):
        ?>
        <a href="drinkkilistaus.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
    <?php endif; ?>
    <?php if ($data->sivu < $data->sivuja): ?>
        <a href="drinkkilistaus.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
    <?php endif; ?>

    <p>
        Yhteensä <?php echo $data->DrinkkiLkm; ?> ainesosaa. 
        Olet sivulla <?php echo $data->sivu; ?>/<?php echo $data->sivuja; ?>.
</body>
</html>
