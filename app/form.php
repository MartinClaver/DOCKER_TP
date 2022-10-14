<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="./style/style.css" />
</head>
<body>
  <form class="box" action="login.php" method="post" name="login">
    <h1 class="box-title">Connexion</h1>

    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
    <input type="password" class="box-input" name="password" placeholder="Mot de passe">
    <input type="submit" value="Connexion " name="submit" class="box-button">

    <p class="box-register">Vous êtes nouveau ici? <a href="./registration/register.php">S'inscrire</a></p>
    <?php if (!empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
    
  </form>
</body>
</html>