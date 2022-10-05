<?php

// Fonction qui vérifie si l'user est connecté. S'il est connecté alors il y a une session en cours
function userIsConnected(){

    if(!isset($_SESSION['membre'])){
        return false;
    }else{
        return true;
    }
}

// Fonction qui vérifie si l'user est Admin

function userIsAdmin(){
    
    if(userIsConnected() && $_SESSION['membre']['statut'] == 1){
        return true;
    }else{
        return false;
    }
}