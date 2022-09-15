<?php


require_once __DIR__."/../Models/Client.php";
require_once __DIR__.'/../config/Database.php';
require_once 'BaseController.php';
require_once __DIR__."/../Utilities/ClientUtils.php";


/**
 * Client controller class. It handle all the request related to the client
 */
Class ClientController extends BaseController{

    private $conn;
    private $dbClient;

    public function __construct(){
        
        $database = new Database();
        $conn = $database->connect();

        //create the sdbClient object
        $this->dbClient =  new Client($conn);
    }

    /**
     * Get all the clients
     * @param: inputParam not used
     */
    public function getClients($inputParam = null){

        //validate the inputParam
            
        $result = $this->dbClient->getDBClients();

        $client_results = ClientUtils::formatDataClients($result);

        $this->sendJSON($client_results);
    }

    /**
     * Get a single client
     * @param: intputParam the id of the desired client
     */
    public function getClient($intputParam = null){
        
        //TODO: validate the param

        $result = $this->dbClient->getDBOneClient($intputParam);

       //if the client is not found
        if(isset($result)){
           
            $client_result = ClientUtils::formatDataClient($result);

            $this->sendJSON($client_result);
        }

        $this->sendNotFound();
    }

}