<!DOCTYPE html>
<body>
    <div class="container">
    <h1>Rekisteröidy</h1>
    <form action="rekisteroidy.php" method="POST">
    <form class="form-horizontal" role="form" action="lomake.html" method="POST">
      <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="username" name="username" placeholder="Text" value="<?php echo $data->nimi; ?>">
        </div>
      </div>
        <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Sähköposti</label>
        <div class="col-md-10">
          <input type="text" class="form-control" id="email" name="email" placeholder="Sähköposti" value="<?php echo $data->sahkoposti; ?>">
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
          <button type="submit" class="btn btn-default">Rekisteröidy</button>
        </div>
      </div>
    </form>
  </div>
