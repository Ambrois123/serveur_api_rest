<?php

use APIManager as GlobalAPIManager;

require_once "Models/Client.php";
require_once "Models/Salle.php";
include_once 'config/Database.php';
require_once "Utilities/ClientUtilities.php";


class APIManager {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    /**
     * Retourne la liste des clients
     *
     * @return array
     */
    public function getClients() : array
    {

        $dbClient = new Client($this->conn);
        $result = $dbClient->getDBClients();

        $client_results = ClientUtilities::formatDataClients($result);

        return $client_results;

    }

    public function getDBOneClient($idClient){

        $dbClient = new Client($this->conn);
        $result = $dbClient->getDBOneClient($idClient);

        echo count($result);
       
        if(isset($result)){
           
            $client_result = ClientUtilities::formatDataClient($result);

            return $client_result;
        }

        return null;
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

   

    

      private static function sendResponse($response){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        return json_encode($response);
      }

    
}