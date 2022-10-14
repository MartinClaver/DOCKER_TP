<?php
session_start();
require_once('./registration/require/config.php');
// On vérifie que les champs sont bien remplis puis on fait une requête du username et du password puis on démarre une session avec le token de l'utilisateur
if (!empty($_POST['username']) && !empty($_POST['password']))
{
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);
  $username = strtolower($username);

  $check = $bdd->prepare('SELECT username, password, token FROM user WHERE username = ?');
  $check -> execute (array($username));
  $data = $check->fetch();
  $row = $check->rowCount();
  if($row > 0)
  {
    if($password === $data['password'])
    {
      $_SESSION['user'] = $data['token'];
      header("Location: blog.php");
      die();
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    header("Location: form.php");
    die();
  };} die();}
?>
