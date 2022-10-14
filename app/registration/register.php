<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style/style.css" />
</head>
<body>
<?php
require_once('./require/config.php');
if (!empty($_POST['username']) && !empty($_POST['password'])){
  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $username = htmlspecialchars($_POST['username']);
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $password = htmlspecialchars($_POST['password']);
  $check = $bdd->prepare('SELECT username, password FROM user WHERE username = ?');
  $check -> execute (array($username));
  $data = $check->fetch();
  $row = $check->rowCount();

  $username = strtolower($username);

    if($row == 0){
      $insert = $bdd-> prepare('INSERT INTO user(username, password, token) VALUES(:username, :password, :token)');
      $insert-> execute(array(
        'username' => $username,
        'password' => $password,
        'token' => bin2hex(openssl_random_pseudo_bytes(64))
      ));
       echo "<div class='success'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='../form.php'>connecter</a></p>
       </div>";
    }
    else{
      echo "<div class='fail'>
             <h3>Vous n'êtes pas inscrit</h3>
             <p>Le nom d'utilisateur existe déjà...</p>
             <p>Cliquez ici pour vous <a href='register.php'>recommencer</a></p>
       </div>";
    }
}else{
?>
<form class="box" action="" method="post">
    <h1 class="box-title">S'inscrire</h1>
  <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="../form.php">Connectez-vous ici</a></p>
</form>
<?php } ?>
</body>
</html>