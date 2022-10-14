<?php
// Informations d'identification
try 
{
$engine = 'mysql';
$host= 'database';
$username='root';
$password='password';
$db_name='data';
 
// Connexion à la base de données MySQL 
$bdd = new PDO("$engine:host=$host;dbname=$db_name", $username, $password );
}
// Vérifier la connexion
catch(PDOException $e)
{
    die('Erreur : '.$e->getMessage());
}
?>