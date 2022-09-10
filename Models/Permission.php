<?php

/**
 * class perms
 */

 class Permission{

     // Constructor with DB
     public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * DB perms
     */

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
        $perms;
    }
 }