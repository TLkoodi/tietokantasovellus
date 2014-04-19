<!DOCTYPE html>
<body>
    <h1><?php echo htmlspecialchars($data->nimi) ?></h1>
    <div>
        <?php echo htmlspecialchars($data->kuvaus) ?>
    </div>

<div class="col-md-10">
    <h2>Drinkit jotka sisältävät tätä ainesosaa</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Drinkin nimi</th>
                <th>Viimeksi muokattu</th>
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
                        
                    </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>