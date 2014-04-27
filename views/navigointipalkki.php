<!DOCTYPE html>
<nav>
    <a href="./drinkkilistaus.php">Drinkit</a>
    <a href="./ainesosalistaus.php">Ainesosat</a>
    <?php if ($_SESSION['kayttajataso'] == 1){ ?>
        <a href="./kayttajalistaus.php">Käyttäjälistaus</a>
    <?php } ?>
    <a href="./uloskirjautuminen.php">Kirjaudu ulos</a>
</nav>
</html>
