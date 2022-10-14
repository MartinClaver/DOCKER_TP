<?php
require_once('./registration/require/config.php');
if(!empty($_GET['id']))
{
    $id = intval($_GET['id']);
    $check = $bdd->prepare('DELETE FROM post WHERE post.post_id=:id');
    $check -> execute (array(
    'id' => $id,
    ));
    header("Location: blog.php");
        die();
}
?>
