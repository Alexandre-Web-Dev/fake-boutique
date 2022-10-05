<!--------------------------PARTIE TRAITEMENT----------------->

<?php 
require_once('inc/init.php');

if(!userIsConnected()){
    header('location:index.php');
    exit();
}

if(userIsAdmin()){
    $content .= '<h1> Bonjour vous êtes Admin du site</h1>';
}

?>

<!--------------------------PARTIE AFFICHAGE----------------->

<?php require_once('inc/head.php'); ?>
<?=$content ?>

<?php
    echo '<div class="alert alert-info h1 justify-content-center text-center" role="alert">';
    echo "Votre pseudo :".$_SESSION['membre']['pseudo'] ."<br>";
    echo "Votre nom :".$_SESSION['membre']['nom']."<br>"; 
    echo "Votre prenom :".$_SESSION['membre']['prenom']."<br>"; 
    echo "Votre adresse :".$_SESSION['membre']['adresse']."<br>"; 
    echo "Votre code postal :".$_SESSION['membre']['code_postal']."<br>"; 
    echo "Votre ville :".$_SESSION['membre']['ville']."<br>"; 
    echo "</div>";

?>

<?php require_once('inc/footer.php'); ?>