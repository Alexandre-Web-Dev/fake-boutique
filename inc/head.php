<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="inc/apple.svg">
    <link rel="stylesheet" href="inc/css/style.css">
    <title>Boutique WF3</title>
</head>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>



                <a class="navbar-brand" href="<?=URL ?>index.php">Boutique</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?=URL ?>index.php">ACCUEIL</a></li>

                    <!--Si l'user est admin, il aura acces à la partie backend du site-->
                    <?php  if (userIsAdmin()) : ?>
                        <li class="active"><a href="<?=URL ?>/admin">BackOffice</a></li>
                    <?php  endif ?>
                    
                        <!--Si l'user est client, il aura acces à toutes les menus sauf connexion et inscription-->
                    <?php  if (userIsConnected()) : ?>
                        <li><a href="<?=URL ?>inscription.php">PROFIL</a></li>

                        <li><a href="<?=URL ?>connexion.php?action=deconnexion">DECONNEXION</a></li>

                        <li><a href="<?=URL ?>boutique.php">BOUTIQUE</a></li>

                        <li><a href="<?=URL ?>panier.php">PANIER</a></li>
                    
                    <?php  else: ?>

                        <li><a href="<?=URL ?>inscription.php">INSCRIPTION</a></li>
                    <li><a href="<?=URL ?>connexion.php">CONNEXION</a></li>
                    <li><a href="<?=URL ?>boutique.php">BOUTIQUE</a></li>

                    <li><a href="<?=URL ?>panier.php">PANIER</a></li>

                    <?php  endif ?>


                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">

        <div class="starter-template">