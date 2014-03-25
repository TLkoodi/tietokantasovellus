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
    <div class="container">
    <h1>Kirjaudu</h1>
    <form action="kirjaudu.php" method="POST">
    <form class="form-horizontal" role="form" action="lomake.html" method="POST">
      <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="username" name="username" placeholder="Text" value="<?php echo $data->kayttaja; ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword1" class="col-md-2 control-label">Salasana</label>
        <div class="col-md-10">
          <input type="password" class="form-control" id="inputPassword1" name="password" placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Kirjaudu sisään</button>
        </div>
      </div>
    </form>
  </div>
    
    <div align="left">
        <a href="./rekisteroidy.html">Rekiströidy</a>
    </div>
    
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>

    
</body>
</html>
