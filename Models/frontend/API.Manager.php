<?php

require_once "Models/Model.php";

class APIManager extends Model{

    public function getClients(){
        $req = "SELECT * 
        from Api_client
        ";
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $clients = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $clients;
    }

    public function getDBOneClient($idClient){
        $req = "SELECT * 
        from Api_client
        WHERE Api_client.client_id = :idClient
        ";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":idClient", $idClient,PDO::PARAM_INT);
        $statement->execute();
        $oneClient = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $oneClient;
    }

    public function getDBSalles(){
        $req = "SELECT * 
        from Api_salle
        INNER JOIN Api_zone ON Api_zone.salle_id = Api_salle.salle_id
        INNER JOIN Api_branch ON Api_branch.salle_id = Api_salle.salle_id
        INNER JOIN Api_install_perms ON Api_install_perms.salle_id = Api_salle.salle_id
        ";
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $salles = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $salles;
    }

    public function getDBOneSalle($idSalle){
        $req = "SELECT * 
        from Api_salle
        INNER JOIN Api_zone ON Api_zone.salle_id = Api_salle.salle_id
        INNER JOIN Api_branch ON Api_branch.salle_id = Api_salle.salle_id
        INNER JOIN Api_install_perms ON Api_install_perms.salle_id = Api_salle.salle_id
        WHERE Api_salle.salle_id = :idSalle
        ";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":idSalle", $idSalle,PDO::PARAM_INT);
        $statement->execute();
        $oneSalle = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $oneSalle;
    }

    public function getDBPerms(){
        $req = "SELECT * 
        from Api_install_perms
        INNER JOIN Api_salle ON Api_salle.salle_id= Api_install_perms.salle_id
        INNER JOIN Api_grants ON Api_grants.perms_id = Api_install_perms.perms_id
        ";
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $perms= $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return self::sendJSON($perms);
    }

    
}