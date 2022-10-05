<?php
//1-Connexion à la bdd

$pdo = new PDO(
    'mysql:host=localhost;dbname=boutique_ali',
    'root',
    'root',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    )
);

var_dump($pdo);

//2- Ouvrir une session

session_start();

//3- Définir une constante URL qui contient l'url de la boutique

define("URL", "http://localhost:8888/php/WF3PHP/boutique_ali/");

define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . '/WF3PHP/boutique_ali/');


//Définir une variable qui va contenir nos alertes

$content = '';

require_once('function.php');
