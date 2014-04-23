<!DOCTYPE html>
<head>
    <title>Ainesosat</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
</head>
<body>
    <h1>Ainesosat</h1>

    <div class="ainesosa">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ainesosan nimi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->ainesosat as $ainesosa): ?>
                    <tr>
                        <td>
                            <a href="ainesosaTieto.php?id=<?php echo  htmlspecialchars($ainesosa->getNimi()) ?>"><?php echo htmlspecialchars($ainesosa->getNimi()) ?></a>
                        </td>
                        <td>
                            <?php if($data->taso === 1){?>
                            <form action="./muokkaaAinesosaa.php?id=<?php echo htmlspecialchars($ainesosa->getNimi()) ?>" method="POST">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn btn-default">Muokkaa ainesosaa</button>
                                </div>
                            </form>
                            <?php } ?>
                        </td>
                        <td>
                            <form action="./poistaAinesosa.php?id=<?php echo htmlspecialchars($ainesosa->getID()) ?>" method="POST">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn btn-default">Poista ainesosa</button>
                                </div>

                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                    <td>
                        <form action="lisaaainesosa.php" method="POST">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-default">Lisää ainesosa</button>
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
        <a href="ainesosalistaus.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
    <?php endif; ?>
    <?php if ($data->sivu < $data->sivuja): ?>
        <a href="ainesosalistaus.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
    <?php endif; ?>

    <p>
        Yhteensä <?php echo $data->AinesosaLkm; ?> ainesosaa. 
        Olet sivulla <?php echo $data->sivu; ?>/<?php echo $data->sivuja; ?>.
</body>
</html>

