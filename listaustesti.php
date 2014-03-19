<?php
//Lista asioista array-tietotyyppiin laitettuna:
$lista = array("Kirahvi", "Trumpetti", "Jeesus", "Parta");
?><!DOCTYPE HTML>
<html>
  <head><title>Otsikko</title>
  
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css"></head>
  <body>
    <h1>Listaelementtitesti</h1>
    <ul>
    <?php foreach($lista as $asia) { ?>
      <li><?php echo $asia; ?></li>
    <?php } ?>
    </ul>
  </body>
</html>
