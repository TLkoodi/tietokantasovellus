<?php
  session_start();

  //Poistetaan istunnosta merkintä kirjautuneesta käyttäjästä -> Kirjaudutaan ulos
  unset($_SESSION['kayttaja']);
  unset($_SESSION['kayttajataso']);
  //Yleensä kannattaa ulkos kirjautumisen jälkeen ohjata käyttäjä kirjautumissivulle
  header('Location: kirjaudu.php');
?>
