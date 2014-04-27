<!DOCTYPE html>
<body>
    <h1><?php echo htmlspecialchars($data->nimi) ?></h1>

    <div>
        <b>Lempinimet:</b> <?php echo htmlspecialchars($data->lempinimet) ?>
    </div>

    <div>
        <b>Resepti:</b> <?php echo htmlspecialchars($data->valmistusohje) ?>
    </div>

    <div>
        <?php echo htmlspecialchars($data->kayttaja) ?>
    </div>

<div class="col-md-10">
    <h2>Drinkin ainesosat</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ainesosan nimi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($data->ainesosat as $ainesosa): ?>
        <tr>
            <td>
                <a href="ainesosaTieto.php?id=<?php echo htmlspecialchars($ainesosa->getNimi()) ?>"><?php echo htmlspecialchars($ainesosa->getNimi()) ?></a>
            </td>
            <?php if ($data->taso == 1) { ?>
            <td>                 
                <form action="./muokkaaAinesosaa.php?id=<?php echo htmlspecialchars($ainesosa->getNimi()) ?>" method="POST">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-default">Muokkaa ainesosaa</button>
                    </div>
                </form>
            </td>
            <?php } ?>
        </tr>
    <?php endforeach; ?>


<div class="col-md-10">


</div>

</body>
</html>
