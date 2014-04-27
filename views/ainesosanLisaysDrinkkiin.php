<!DOCTYPE html>
<body>
    <h1>Lisää ainesosa drinkkiin <?php echo $data->nimi; ?></h1>
    <div class="pure-form pure-form-stacked">
        <fieldset>
        <div id="navcontainer">
            <ul id="navlist">
                <form action="drinkki_ainesosalisays.php" method="POST">
                    <div class="col-md-offset-2 col-md-10">   
                    <label for="inputText">Kirjoita ainesosan nimi</label>
                    </div>
                    <div class="col-md-offset-2 col-md-5">
                            <input type="text" class="form-control" id="lisattavaAinesosa" name="lisattavaAinesosa" placeholder="Ainesosa" value="<?php echo htmlspecialchars($data->lisattavaAinesosa); ?>">
                        
                    </div>
                        <div class="col-md-offset-2 col-md-10">
                        <label for="inputText">Kirjoita ainesosalle kuvaus (Jos ainesosa on löytyy jo palvelusta, säilytetään vanha kuvaus).</label>
                        </div>
            <div class="col-md-offset-2 col-md-5">
                            <input type="text" class="form-control" id="description" name="kuvaus" placeholder="Kuvaus"value="<?php echo htmlspecialchars($data->kuvaus); ?>">
                        
                    </div>

                    <input type="hidden" name="id" value="<?php echo $data->id; ?>">

                    <div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default">Lisää ainesosa drinkkiin</button>
                        </div>
                    </div>
                </fieldset>
                </form>
        </div>
                <form action="drinkkilistaus.php" method="POST">
                    <div class="row">
                        <div class="col-md-offset-2">
                            <button type="submit" class="btn btn-default">Lopeta ainesosien lisäys</button>
                        </div>
                    </div>
                </form>
        </div>
 
</body>
</html>
