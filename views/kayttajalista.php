<!DOCTYPE html>
<body>
    <h1>Käyttäjät</h1>

    <div class="kayttaja">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Käyttäjän nimi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->kayttajat as $kayttaja): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($kayttaja->getNimi()) ?>
                        </td>
                        <td>
                            <form action="./kayttajaTasonMuutos.php?id=<?php echo htmlspecialchars($kayttaja->getNimi()) ?>" method="POST">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn btn-default">
                                        <?php if ($kayttaja->getKayttajataso() == 2) { ?>
                                            Anna ylläpito-oikeudet
                                        <?php } if ($kayttaja->getKayttajataso() == 1) { ?>
                                            Poista ylläpito-oikeudet
                                        <?php } ?>
                                    </button>
                                </div>
                            </form>

                        </td>
                        <td>
                            
                                <form action="./poistaKayttaja.php?id=<?php echo htmlspecialchars($kayttaja->getNimi()) ?>" method="POST">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="submit" class="btn btn-default">Poista käyttäjä</button>
                                    </div>

                                </form>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            <td><td></td></td></tr>
            </tbody>
        </table>
    </div>
</body>
</html>
