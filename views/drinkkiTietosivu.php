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
    <h1><?php echo htmlspecialchars($data->nimi) ?></h1>
    
    <div>
        <?php echo htmlspecialchars($data->lempinimet) ?>
    </div>
    
    <div>
        <?php echo htmlspecialchars($data->valmistusohje) ?>
    </div>
    
    <div>
        <?php echo htmlspecialchars($data->kayttaja) ?>
    </div>

<div class="col-md-10">

</div>

</body>
</html>
