<?php
/**
 * class salle
 */ 

 class Salle{

    private $conn;
    private $table = 'api_salle';
    /**
     * connex to DB
     */

      // Constructor with DB
    public function __construct($db) {

        $this->conn = $db;
    }

    /**
     * 
     *
     * connexion salles
     */
    public function getDBSalles(){
        $req = "SELECT *" .$this->table; 
        // from Api_salle
        // INNER JOIN Api_zone ON Api_zone.salle_id = Api_salle.salle_id
        // INNER JOIN Api_branch ON Api_branch.salle_id = Api_salle.salle_id
        // INNER JOIN Api_install_perms ON Api_install_perms.salle_id = Api_salle.salle_id
        ";
        $statement = $this->conn->prepare($req);
        $statement->execute();
        $salles = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $salles;
    }

    /**
     * connexion one salle
     */

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



 }

