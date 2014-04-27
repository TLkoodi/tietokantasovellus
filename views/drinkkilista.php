<!DOCTYPE html>
<body>
    <h1>Drinkit</h1>

    <div class="ainesosa">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Drinkin nimi</th>
                    <th>Lisännyt</th>
                </tr>
            </thead>
            <?php if (empty($data->drinkit)){?>
            <div class="alert alert-danger">Drinkkejä ei löytynyt</div>
            <?php } ?>
            <tbody>
                <?php foreach ($data->drinkit as $drinkki): ?>
                    <tr>
                        <td>
                            <a href="drinkkiTieto.php?id=<?php echo htmlspecialchars($drinkki->getNimi()) ?>"><?php echo htmlspecialchars($drinkki->getNimi()) ?></a>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($drinkki->getKayttajanimi()) ?>
                        </td>
                        <?php if ($data->taso == 1) { ?>
                            <td>

                                <form action="./muokkaaDrinkkia.php?id=<?php echo htmlspecialchars($drinkki->getNimi()) ?>" method="POST">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="submit" class="btn btn-default">Muokkaa drinkkiä</button>
                                    </div>
                                </form>
                            </td>
                        <?php } if ($data->taso === 1) { ?>
                            <td>
                                <form action="./poistaDrinkki.php?id=<?php echo htmlspecialchars($drinkki->getID()) ?>" method="POST">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="submit" class="btn btn-default">Poista drinkki</button>
                                    </div>

                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>

                <?php if ($data->taso === 1) { ?>
                <td>
                    <form action="lisaadrinkki.php" method="POST">
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-default">Lisää drinkki</button>
                        </div>

                    </form></td>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php if ($data->sivu > 1):
        ?>
        <a href="drinkkilistaus.php?sivu=<?php echo $data->sivu - 1; ?>">Edellinen sivu</a>
    <?php endif; ?>
    <?php if ($data->sivu < $data->sivuja): ?>
        <a href="drinkkilistaus.php?sivu=<?php echo $data->sivu + 1; ?>">Seuraava sivu</a>
    <?php endif; ?>

    <p>
        <form action="drinkkiHaku.php" method="POST">
                    <div class="form-group">
                        <label for="inputText" class="col-md-2 control-label">Hae drinkkiä</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="hakusana" name="hakusana" placeholder="Drinkki" value="">
                        </div>
                    </div>
        </form>
        <?php if (!empty($data->DrinkkiLkm) && !empty($data->sivu)){?>
        Yhteensä <?php echo $data->DrinkkiLkm; ?> drinkkiä. 
        Olet sivulla <?php echo $data->sivu; ?>/<?php echo $data->sivuja; ?>.
        <?php } ?>
</body>
</html>
