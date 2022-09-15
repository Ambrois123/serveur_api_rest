<?php


require_once __DIR__."/../Models/Offer.php";
require_once __DIR__.'/../config/Database.php';
require_once 'BaseController.php';
require_once __DIR__."/../Utilities/OfferUtils.php";


/**
 * Client controller class. It handle all the request related to the client
 */
Class OfferController extends BaseController{

    private $conn;
    private $dbOffer;

    public function __construct(){
        
        $database = new Database();
        $conn = $database->connect();

        //create the sdbClient object
        $this->dbOffer =  new Offer($conn);
    }

    /**
     * Get all the clients
     * @param: inputParam not used
     */
    public function getOffers($inputParam = null){

        //validate the inputParam
            
        $result = $this->dbOffer->getDBOffers();

        $offer_results = OfferUtils::formatDataOffers($result);

        $this->sendJSON($offer_results);
    }

    /**
     * Get a single client
     * @param: intputParam the id of the desired client
     */
    public function getOffer($intputParam = null){
        
        //TODO: validate the param

        $result = $this->dbOffer->getDBOneOffer($intputParam);

       //if the client is not found
        if(isset($result)){
           
            $offer_result = OfferUtils::formatDataOffer($result);

            $this->sendJSON($offer_result);
        }

        $this->sendNotFound();
    }

}