<!DOCTYPE html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
<body>
    <h1><?php echo $data->nimi?></h1>
    <div>
       <?php echo $data->kuvaus?>
    </div>
    
     <a href="./muokkaaAinesosaa.php?id=<?php echo $data->nimi ?>">Muokkaa ainesosaa</a>
</form>
    
    <div class="container">
        <h2>Drinkit jotka sisältävät tätä ainesosaa</h2>
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Drinkin nimi</th>
                        <th>Viimeksi muokattu</th>
                        <th>Lisännyt</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="./karhuviinabattery.html">Karhuviinabattery</a></td>
                        <td>23.11.2013 18:01</td>
                        <td>admin</td>
                    </tr>
                </tbody>
            </table>
    </div>
 
</body>
</html>