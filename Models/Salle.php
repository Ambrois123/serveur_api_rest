<?php
/**
 * class salle
 */ 

 class Salle
 {
    private $conn;
    private $table = 'api_salle';
    /**
     * construct with db
     */
    public function __construct($db) {

        $this->conn = $db;
    }
    /**
     * recup data salle
     */
    public function getDBSalles(){
        $req = "SELECT * from " .$this->table ." s
        INNER JOIN api_install_perms ip ON s.salle_id = ip.salle_id
        INNER JOIN api_grants g ON s.salle_id = g.salle_id
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

    public function getDBOneSalle($idSalle)
    {
        $req = "SELECT * from " .$this->table ." s
        INNER JOIN api_install_perms ip ON s.salle_id = ip.salle_id
        INNER JOIN api_grants g ON s.salle_id = g.salle_id
        WHERE s.salle_id = :idSalle
        ";
        $statement = $this->conn->prepare($req);
        $statement->bindValue(":idSalle", $idSalle, PDO::PARAM_INT);
        $statement->execute();
        $oneSalle = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        return $oneSalle;
    }
    

 }

