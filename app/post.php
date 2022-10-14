<?php
session_start();
require_once('./registration/require/config.php');
if (!empty($_POST['poste'])){
    $post = htmlspecialchars($_POST['poste']);
    $check = $bdd->prepare('SELECT * FROM user WHERE token = :token');
    $check -> execute (array(
    'token' => $_SESSION["user"]));

    $user = $check->fetch();
        $insert = $bdd-> prepare('INSERT INTO post(post, author) VALUES(:post, :author)');
        $insert-> execute(array(
          'post' => $post,
          'author' => $user['id'])
        );
    header("Location: blog.php");
    die();
    }
else{
    $message = "Le post est vide.";
    header("Location: blog.php");
    die();
}