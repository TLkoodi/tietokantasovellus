<!DOCTYPE html>

<body>
    <h1>Lisää ainesosa drinkkiin <?php echo $data->nimi; ?></h1>
    <div class="container">
        <div id="navcontainer">
            <ul id="navlist">
                <form action="drinkki_ainesosalisays.php" method="POST">
                    <div class="form-group">
                        <label for="inputText" class="col-md-2 control-label">Kirjoita ainesosan nimi</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="lisattavaAinesosa" name="lisattavaAinesosa" placeholder="Ainesosa" value="<?php echo htmlspecialchars($data->lisattavaAinesosa); ?>">
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $data->id; ?>">

                    <div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default">Lisää ainesosa drinkkiin</button>
                        </div>
                    </div>
                </form>

                <form action="drinkkilistaus.php" method="POST">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default">Lopeta ainesosien lisäys</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</body>
</html>
