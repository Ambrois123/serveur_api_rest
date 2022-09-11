<?php

require_once "../Models/Client.php";
include_once '../config/Database.php';
require_once 'BaseController.php';

/**
 * Client controller class. It handle all the request related to the client
 */
Class ClientController extends BaseController{

    private $conn;
    private $dbClient;

    public function __constructor(){
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
        
        $result = $dbClient->getDBClients();

        $client_results = ClientUtilities::formatDataClients($result);

        sendJSON($client_results);
    }

    /**
     * Get a single client
     * @param: intputParam the id of the desired client
     */
    public function getClient($intputParam = null){
        
        //TODO: validate the param
        $result = $thisdbClient->getDBOneClient($idClient);

       //if the client is not found
        if(isset($result)){
           
            $client_result = ClientUtilities::formatDataClient($result);

            sendJSON($client_result);
        }

        sendNotFound();
    }

}