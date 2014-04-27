<html>
    <h1>Muokkaa ainesosaa</h1>
    <body>
        <div class="container">

            <form action="muokkaaAinesosaa.php?id=<?php echo htmlspecialchars($data->ainesosa->getNimi()); ?>" method="POST">
                <div class="form-group">
                    <label for="inputText" class="col-md-2 control-label">Ainesosan nimi</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="username" name="muokattavaNimi" placeholder="Text" value="<?php echo htmlspecialchars($data->ainesosa->getNimi()); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputText" class="col-md-2 control-label">Kuvaus</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="inputPassword1" name="muokattavaKuvaus" placeholder="Kuvaus"value="<?php echo htmlspecialchars($data->ainesosa->getKuvaus()); ?>">
                    </div>

                    <input type="hidden" name="id" value="<?php echo $data->ainesosa->getID(); ?>">
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-default">Muokkaa ainesosaa</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>