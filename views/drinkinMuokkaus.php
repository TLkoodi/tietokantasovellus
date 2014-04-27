<html>
    <h1>Muokkaa drinkkiä</h1>
    <body>
        <div class="container">

            <form action="muokkaaDrinkkia.php?id=<?php echo htmlspecialchars($data->drinkki->getNimi()); ?>" method="POST">
                <div class="form-group">
                    <label for="inputText" class="col-md-2 control-label">Drinkin nimi</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="username" name="muokattavaNimi" placeholder="Text" value="<?php echo htmlspecialchars($data->drinkki->getNimi()); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputText" class="col-md-2 control-label">Lempinimet</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="nicknames" name="muokattavaLempinimet" placeholder="lempinimet"value="<?php echo htmlspecialchars($data->drinkki->getLempinimet); ?>">
                    </div>

                    <input type="hidden" name="id" value="<?php echo $data->drinkki->getID(); ?>">
                </div>
                <div class="form-group">
                    <label for="inputText" class="col-md-2 control-label">valmistusohje</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="inputPassword1" name="muokattavaValmistusohje" placeholder="valmistusohje"value="<?php echo htmlspecialchars($data->drinkki->getValmistusohje()); ?>">
                    </div>

                    <input type="hidden" name="id" value="<?php echo $data->drinkki->getID(); ?>">
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-default">Päivitä drinkkin tiedot</button>
                    </div>
                </div>
            </form>
            
            <form action="./drinkki_ainesosalisays.php?id=<?php echo  htmlspecialchars($data->drinkki->getID()) ?>" method="POST">
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-default">Lisää drinkkiin ainesosia!</button>
                </div>
            </div>
    </form>
        </div>
    </body>
</html>
