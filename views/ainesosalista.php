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
                            <a href="ainesosaTieto.php?id=<?php echo $ainesosa->getNimi() ?>"><?php echo $ainesosa->getNimi() ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
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
        <a href="aineosalistaus.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
    <?php endif; ?>
    <?php if ($data->sivu < $data->sivuja): ?>
        <a href="aineosalistaus.php.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
    <?php endif; ?>

    <a href="lisaaainesosa.php">Lisää uusi ainesosa</a>
    <p>
        Yhteensä <?php echo $data->AinesosaLkm; ?> ainesosaa. 
        Olet sivulla <?php echo $data->sivu; ?>/<?php echo $data->sivuja; ?>.
</body>
</html>

