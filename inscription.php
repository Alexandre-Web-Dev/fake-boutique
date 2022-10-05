<!--------------------------PARTIE TRAITEMENT----------------->
<?php 

require_once('./inc/init.php');


if($_POST){
    
    $erreur = "";

    if(strlen($_POST['pseudo'])<3 ||strlen($_POST['pseudo'])>20){
        $erreur .= '<div class="alert alert-danger" role="alert">Votre pseudo doit être compris entre 3 et 20 caractères</div>';
    }

    //rowCount — Retourne le nombre de lignes affectées par le dernier appel à la fonction
    $r = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");

    if($r->rowCount()>=1){
        $erreur .= '<div class="alert alert-danger" role="alert">Pseudo indisponible</div>';
    }

    if(!preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo'])){
        $erreur .= '<div class="alert alert-danger" role="alert">Format non autorisé pour le pseudo</div>';
    }

    $_POST['mdp'] = password_hash($_POST['mdp'],PASSWORD_DEFAULT);

    foreach($_POST as $indice =>$value){
        $_POST[$indice] = htmlentities(addslashes($value));
    }

    if(empty($erreur)){
        $pdo->query("INSERT INTO membre(pseudo,mdp,nom,prenom,email,civilite,ville,code_postal,adresse) VALUES('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[civilite]','$_POST[ville]','$_POST[cp]','$_POST[adresse]')");

        $content = '<div class="alert alert-success" role="alert">User bien enrégistré</div>';
    
    }

$content .= $erreur;

}

//1-Requête d'ajout d'un user
// Vérifier que la longueur du pseudo est entre 3 et 20 caractères
// Vérifier si le pseudo contient les exprèsssions autorisées #^[a-zA-Z0-9._-]+$# en utilisant preg_match()
// Vérifier si le pseudo est disponible
//2 - A FAIRE ENSEMBLE : LES FAILLES XSS ET SQL
//3 - Crypter le mot de passe avec password_hash()
?>


<!--------------------------PARTIE AFFICHAGE----------------->
<?php require_once('./inc/head.php'); ?>

<?= $content ?>

<form method="post" action="">

    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" placeholder="votre pseudo" name="pseudo" id="pseudo" >

    <label for="mdp">Mot de passe</label>
    <input type="password" class="form-control" placeholder="votre mot de passe" name="mdp" id="mdp" required>

    <label for="nom">Nom</label>
    <input type="text" class="form-control" placeholder="votre nom" name="nom" id="nom">

    <label for="prenom">Prenom</label>
    <input type="text" class="form-control" placeholder="votre prenom" name="prenom" id="prenom">

    <label for="email">Email</label>
    <input type="email" class="form-control" placeholder="votre email" name="email" id="email" required>

    <br>
    <label for="civilite">civilite</label>
    <input type="radio" class="" name="civilite" id="civilite" value="m" checked>
    Homme -- Femme
    <input type="radio" class="" name="civilite" id="civilite" value="f"><br>

    <label for="ville">ville</label>
    <input type="text" class="form-control" placeholder="votre ville" name="ville" id="ville">

    <label for="cp">code postal</label>
    <input type="text" class="form-control" placeholder="votre cp" name="cp" id="cp">

    <label for="adresse">adresse</label>
    <textarea class="form-control" placeholder="votre adresse" name="adresse" id="adresse"></textarea><br>

    <input type="submit" class="btn btn-success btn-lg">

</form>

<?php require_once('./inc/footer.php'); ?>