<?php
    session_start();
    require_once('./registration/require/config.php');
    if(!isset($_SESSION["user"])){
    header("Location: form.php");
    exit(); 
    }
    $check = $bdd->prepare('SELECT username, id FROM user WHERE token = :token');
    $check -> execute (array(
    'token' => $_SESSION["user"]));
        
    $user = $check->fetch();

    $check = $bdd->prepare('SELECT * FROM post INNER JOIN user WHERE post.author = user.id');
    $check -> execute();
    $list_post = $check->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css" />
    <title>Document</title>
</head>
<body>
    <h1>Blog perso
    </h1>
    <div class="success">
    <h1>Bienvenue <?php echo $user['username']; ?> !</h1>
    <p>C'est votre tableau de bord.</p>
    <h2>Ecrire un post</h2>

    <form action="post.php" method='post'>
        <textarea name="poste" type="text" id="poste" cols="30" rows="5"></textarea>
        <input type="submit" value="Poster" name="submit" class="box-button">
    </form>

    <?php if (!empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>

    <h2>Liste des posts</h2>

    <?php foreach($list_post as $post):?>

        <?php if($post['author']==$user['id']){ ?>
        <a href='delete.php?id=<?php echo $post['post_id'] ?>'>Supprimer </a>
        <?php };?>

        <div class='list'> <p><?= $post['post'] ?> </p> <p class='from'> écrit par <span class='author'><?= $post['username']?></span></div>
    
    <?php endforeach ?>

    <a href="./logout.php">Déconnexion</a>
    </div>
</body>
</html>
