<html>
    <head>
        <meta charset="UTF-8">
        <title>Lisää tuote</title>
    </head>
    <body>
        <div class="container">

            <form action="lisaaainesosa.php" method="POST">
                    <div class="form-group">
                        <label for="inputText" class="col-md-2 control-label">Ainesosan nimi</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="username" name="nimi" placeholder="Text" value="<?php echo htmlspecialchars($data->ainesosa); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputText" class="col-md-2 control-label">Kuvaus</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="inputPassword1" name="kuvaus" placeholder="Kuvaus"value="<?php echo htmlspecialchars($data->kuvaus); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default">Lisää ainesosa</button>
                        </div>
                    </div>
                </form>
        </div>
    </body>
</html>
