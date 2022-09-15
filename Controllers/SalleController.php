<?php


require_once __DIR__."/../Models/Salle.php";
require_once __DIR__.'/../config/Database.php';
require_once 'BaseController.php';
require_once __DIR__."/../Utilities/SallesUtils.php";


/**
 * Client controller class. It handle all the request related to the client
 */
Class SalleController extends BaseController{

    private $conn;
    private $dbSalle;

    public function __construct(){
        
        $database = new Database();
        $conn = $database->connect();

        //create the sdbClient object
        $this->dbSalle =  new Salle($conn);
    }

    /**
     * Get all the clients
     * @param: inputParam not used
     */
    public function getSalles($inputParam = null){

        //validate the inputParam
            
        $result = $this->dbSalle->getDBSalles();

        //ici result est une liste de salle
        
        $salle_results = SalleUtils::formatDataSalles($result);

        $this->sendJSON($salle_results);
    }

    /**
     * Get a single client
     * @param: intputParam the id of the desired client
     */
    public function getSalle($intputParam = null){
        
        //TODO: validate the param

        $result = $this->dbSalle->getDBOneSalle($intputParam);

       //if the client is not found
        if(isset($result)){
           
            $salle_result = SalleUtils::formatDataSalle($result);

            $this->sendJSON($salle_result);
        }else{
            $this->sendNotFound();
        }

        
    }

}