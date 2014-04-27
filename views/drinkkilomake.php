<html>  
    <h1>Lisää drinkki</h1>
    <body>
        <div class="container">

            <form action="lisaadrinkki.php" method="POST">
                    <div class="form-group">
                        <label for="inputText" class="col-md-2 control-label">Drinkin nimi</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="username" name="nimi" placeholder="Text" value="<?php echo htmlspecialchars($data->drinkki); ?>">
                        </div>
                    </div>
                <div class="form-group">
                        <label for="inputText" class="col-md-2 control-label">Lempinimet</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nicknames" name="lempinimet" placeholder="Lempinimet" value="<?php echo htmlspecialchars($data->lempinimet); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputText" class="col-md-2 control-label">Valmistusohje</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="inputPassword1" name="valmistusohje" placeholder="valmistusohje" value="<?php echo htmlspecialchars($data->valmistusohje); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default">Lisää drinkki</button>
                        </div>
                    </div>
                </form>
        </div>
    </body>
</html>
