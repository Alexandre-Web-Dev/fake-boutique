<!-------------------------------------PARTIE TRAITEMENT------------------------->
<?php require_once('../inc/init.php'); ?>
<?php
//Si l'user n'est pas admin alors je le redirige vers la page d'accueil de la boutiquez
if (!userIsAdmin()) {
    header('location:../index.php');
    exit();
}

?>

<?php
// A la soumission du formulaire
if ($_POST) {
    $photo_bdd = '';


    foreach ($_POST as $indce => $value) {
        $_POST[$indce] = addslashes($value);
    }
    // Je verifie s'il y a l'input image qui n'est pas vide
    if (!empty($_FILES['photo'])) {

        // Je renomme l'image reçu
        $nom_photo = time() . '_' . $_FILES['photo']['name'];

        //Je prépare le chemin pour enrégistrer l'image dans le dossier
        $photo_dossier = RACINE_SITE . "photo/$nom_photo";
        //Je prépare le chemin pour enrégistrer l'image dans la BDD
        $photo_bdd = URL . "photo/$nom_photo";

        copy($_FILES['photo']['tmp_name'], $photo_dossier);
    }


    $pdo->query("INSERT INTO produit(reference,categorie,titre,description,couleur,taille,public,photo,prix,stock) VALUES('$_POST[reference]','$_POST[categorie]','$_POST[titre]','$_POST[description]','$_POST[couleur]','$_POST[taille]','$_POST[public]','$photo_bdd','$_POST[prix]','$_POST[stock]')");
}

// AFFICHAGE DES PRODUITS QUI SONT DANS LA BDD
$r = $pdo->query("SELECT * FROM produit");

$content .= '<h3 style="text-align:center;color:red;"> LISTE DES ' . $r->rowCount() . ' DE NOTRE BOUTIQUE</h3>';

$content .='<table class="table table-striped table-hover"><tr>';
// columnCount() Retourne le nombre de colonnes
for($i=0;$i<$r->columnCount();$i++){

    //getColumnMeta() Retourne les métadonnées pour une colonne
    $colone = $r->getColumnMeta($i);

    $content .='<td class="table-light">'.$colone['name'].'</td>';
}
$content .='<td class="table-light">Modification</td>';
$content .='<td class="table-light">Suppression</td>';
$content .='</tr>';


while($ligne = $r->fetch(PDO::FETCH_ASSOC)){
    $content.= '<tr>';

    foreach($ligne as $indice=>$value){
        if($indice == 'photo'){

            $content.="<td><img src=\"$value\" width=\"50\" height=\"50\"></td>";

        }else{
            $content.='<td>'.$value.'</td>';
        }
    }
// Je récupère l'id du produit dans l'url afin de pouvoir le supprimer ou le modifier
    $content.="<td><a href=\"?action=modification&id_produit=$ligne[id_produit]\">Modifier</a></td>";
    $content.="<td><a href=\"?action=suppression&id_produit=$ligne[id_produit]\">Supprimer</a></td>";

    $content.= '</tr>';
}


$content .='</table>';

$content .='<hr><hr><hr>';



// Supprimer un produit 

if(isset($_GET['action']) && $_GET['action']=='suppression'){
    $pdo->query("DELETE  FROM produit WHERE id_produit='$_GET[id_produit]'");
}


// Modification

if(isset($_GET['action']) && $_GET['action']=='modification'){
    $r = $pdo->query("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'");
    $produit_actuel = $r->fetch(PDO::FETCH_ASSOC);
}

$id_produit  = (isset($produit_actuel['id_produit'])) ? $produit_actuel['id_produit']:'';
$reference  = (isset($produit_actuel['reference'])) ? $produit_actuel['reference']:'';
$categorie  = (isset($produit_actuel['categorie'])) ? $produit_actuel['categorie']:'';
$titre  = (isset($produit_actuel['titre'])) ? $produit_actuel['titre']:'';
$description  = (isset($produit_actuel['description'])) ? $produit_actuel['description']:'';
$couleur = (isset($produit_actuel['couleur'])) ? $produit_actuel['couleur']:'';
$taille  = (isset($produit_actuel['taille'])) ? $produit_actuel['taille']:'';
$public  = (isset($produit_actuel['public '])) ? $produit_actuel['public ']:'';
$photo = (isset($produit_actuel['photo'])) ? $produit_actuel['photo']:'';
$prix  = (isset($produit_actuel['prix'])) ? $produit_actuel['prix']:'';
$stock  = (isset($produit_actuel['stock'])) ? $produit_actuel['stock']:'';

?>



<!-------------------------------------PARTIE AFFICHAGE ------------------------->

<?php require_once('inc/header.php'); ?>

<h2 style="text-align: center;text-transform:uppercase">Gestion des produits</h2>
<?= $content ?>
<h4 style="text-align: center;text-transform:uppercase">Ajout d'un nouveau produit</h4>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="<?=$id_produit?>">    

    <label for="reference">Référence</label>
    <input type="text" class="form-control" id="reference" name="reference" placeholder="Référence du produit " value="<?=$reference?>"><br>


    <label for="catégorie">Catégorie</label>
    <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Catégorie du produit" value="<?=$categorie?>"><br>


    <label for="titre">Titre</label>
    <input type="text" class="form-control" id="titre" name="titre" placeholder="titre du produit" 
    value="<?=$titre?>"><br>

    <label for="description">Description</label>
    <textarea type="text" class="form-control" id="description" name="description" placeholder="description du produit"><?=$description?></textarea><br>

    <label for="couleur">Couleur</label>
    <select name="couleur" id="couleur" class="form-control">
        <option <?php if($couleur=='Blanc') echo 'selected'; ?>>Blanc</option>
        <option <?php if($couleur=='Rouge') echo 'selected'; ?> >Rouge</option>
        <option <?php if($couleur=='Noir') echo 'selected'; ?>>Noir</option>
        <option <?php if($couleur=='Vert') echo 'selected'; ?>>Vert</option>
        <option <?php if($couleur=='Bleu') echo 'selected'; ?>>Bleu</option>
        <option <?php if($couleur=='Violet') echo 'selected'; ?>>Violet</option>
        <option <?php if($couleur=='Jaune') echo 'selected'; ?>>Jaune</option>
    </select>

    <label for="taille">Taille</label>
    <select name="taille" id="taille" class="form-control">
        <option <?php if($taille=='XS') echo 'selected'; ?>>XS</option>
        <option <?php if($taille=='S') echo 'selected'; ?>>S</option>
        <option <?php if($taille=='M') echo 'selected'; ?>>M</option>
        <option <?php if($taille=='L') echo 'selected'; ?>>L</option>
        <option <?php if($taille=='XL') echo 'selected'; ?>>XL</option>
        <option <?php if($taille=='XXL') echo 'selected'; ?>>XXL</option>
    </select>


    <label for="public">Public</label>
    <select name="public" id="public" class="form-control">
        <option value="f" <?php if($public=='f') echo 'selected'; ?>>Femme</option>
        <option value="m" <?php if($public=='m') echo 'selected'; ?>>Homme</option>
        <option value="mixte" <?php if($public=='mixte') echo 'selected'; ?>>Mixte</option>
    </select>

    <label for="photo">Photo</label>
    <input type="file" class="form-control" id="photo" name="photo" value="<?=$photo?>"><br>

    <label for="prix">Prix</label>
    <input type="text" class="form-control" id="prix" name="prix" placeholder="Prix du produit" value="<?=$prix?>"><br>

    <label for="stock">Stock</label>
    <input type="text" class="form-control" id="stock" name="stock" placeholder="stock du produit" value="<?=$stock?>"><br>

    <input type="submit" class="btn btn-lg btn-success" value="AJOUTER LE PRODUIT">

</form>

<?php require_once('inc/footer.php'); ?>


