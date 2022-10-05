<!--------------------------PARTIE TRAITEMENT----------------->
<?php require_once('inc/init.php'); 
//Si dans l'url il y a une action et que cette action == deconnexion
if(isset($_GET['action']) && $_GET['action']=='deconnexion'){
    session_destroy();
}

// Si l'user est déjà connecté et veut accéder à la page connxion je le redirige
if(userIsConnected()){
    header('location:profil.php');
    exit();
}

if($_POST){
    $r = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");

    if($r->rowCount()>=1){

        $membre = $r->fetch(PDO::FETCH_ASSOC);

        if(password_verify($_POST['mdp'],$membre['mdp'])){

            $_SESSION['membre']['id_membre'] = $membre['id_membre'];
            $_SESSION['membre']['pseudo'] = $membre['pseudo'];
            $_SESSION['membre']['nom'] = $membre['nom'];
            $_SESSION['membre']['prenom'] = $membre['prenom'];
            $_SESSION['membre']['email'] = $membre['email'];
            $_SESSION['membre']['civilite'] = $membre['civilite'];
            $_SESSION['membre']['ville'] = $membre['ville'];
        $_SESSION['membre']['code_postal'] = $membre['code_postal'];
            $_SESSION['membre']['adresse'] = $membre['adresse'];
            $_SESSION['membre']['statut'] = $membre['statut'];

            header('location:profil.php');

        }else{
            $content .= '<div class="alert alert-danger" role="alert">
            Mot de passe incorrect</div>';
        }

    }else{
        $content .= '<div class="alert alert-danger" role="alert">
        Cet user n\'existe pas
      </div>';
    }
}

?>


<!--------------------------PARTIE AFFICHAGE----------------->
<?php require_once('inc/head.php'); ?>

<?= $content ?>

<form method="post" action="">

    <label for="pseudo">Pseudo</label>
    <input type="text" class="form-control" placeholder="votre pseudo" name="pseudo" id="pseudo">

    <label for="mdp">Mot de passe</label>
    <input type="password" class="form-control" placeholder="votre mot de passe" name="mdp" id="mdp">
    <input type="submit" class="btn btn-success btn-lg" value="Connexion">

</form>

<?php require_once('inc/footer.php'); ?>