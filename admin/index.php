<?php require_once('../inc/init.php'); ?>

<?php
//Si l'user n'est pas admin alors je le redirige vers la page d'accueil de la boutiquez
if (!userIsAdmin()) {
    header('location:../index.php');
    exit();
}

?>

<?php require_once('inc/header.php'); ?>

<h1>Bienvenue sur le BackOffice de votre boutique en ligne</h1>
<p><strong>Selectionnez l'une des rubriques dans la colonne de gauche.</strong></p>

<?php require_once('inc/footer.php'); ?>