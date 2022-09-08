<?php

class APIController{
    public function getClients(){
        echo "Envoi infos sur clients";
    }
    public function getOneClient($idClient){
        echo "Envoi infos sur le client: ".$idClient;
    }
    public function getSalles(){
        echo "Envoi infos sur salles";
    }
    public function getOneSalle($idSalle){
        echo "Envoi infos sur le client: ".$idSalle;
    }
    public function getFormulaire(){
        echo "Envoi de données pour formulaire";
    }
    
}