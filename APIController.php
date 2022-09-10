<?php

require_once "APIManager.php";
// require_once "models/Model.php";
require_once "Utilities/Utils.php";

class APIController{
    private $apiManager;

    public function __construct(){
        $this->apiManager = new APIManager();
    }
    public function getClients(){
        $clients = $this->apiManager->getClients();
        Util::sendJSON($clients);
        
    }
    public function getOneClient($idClient){
        $oneClient = $this->apiManager->getDBOneClient($idClient);
        Util::sendJSON($oneClient);
    }
    
    public function getSalles(){
       
        $salles = $this->apiManager->getDBSalles();
        //Model::sendJSON($this->formatDataSalles($salles));
    }

    public function getOneSalle($idSalle){
        $oneSalle = $this->apiManager->getDBOneSalle($idSalle);
        Model::sendJSON($this->formatDataSalle($oneSalle));
    }

    private function formatDataSalle($bySalle){
        
        $salleTab = array(

            "salleId" => $bySalle['salle_id'],
            "clientId" => $bySalle['client_id'],
            "SalleName" => $bySalle['salle_name'],
            "SalleAddress" => $bySalle['salle_address'],
            "zoneId" => $bySalle['zone_id'],
            "salleId" => $bySalle['salle_id'],
            "zone name" => $bySalle['zone_name'],
            "branchId" => $bySalle['branch_id'],
            "salleId" => $bySalle['salle_id'],
            "branchName" => $bySalle['branch_name'],
            "permsId" => $bySalle['perms_id'],
            "salleId" => $bySalle['salle_id'],
            "membersRead" => $bySalle['members_read'],
            "membersWrite" => $bySalle['members_write'],
            "membersAdd" => $bySalle['members_add'],
            "membersProductsAdd" => $bySalle['members_products_add'],
            "membersPaymentSchedulesRead" => $bySalle['members_payment_schedules_read'],
            "membersStatistiquesRead" => $bySalle['members_statistiques_read'],
            "membersSubscriptionSead" => $bySalle['members_subscription_read'],
            "paymentSchedulesRead" => $bySalle['payment_schedules_read'],
            "paymentSchedulesWrite" => $bySalle['payment_schedules_write'],
            "paymentDayRead" => $bySalle['payment_day_read']
        );
        // echo "<pre>";
        // print_r($tab);
        // echo "</pre>";
        return $salleTab;
    }


    public function getPerms(){
        $perms = $this->apiManager->getDBPerms();
        Model::sendJSON($this->formatDataPerms($perms));
    }

    private function formatDataPerms($onePerms){
        $permTab = [];
        foreach($onePerms as $onePerm){
            $permTab["Salle_".$onePerm['salle_id']] =[
                "permsId" => $onePerm['perms_id'],
                "salleId" => $onePerm['salle_id'],
                "membersRead" => $onePerm['members_read'],
                "membersWrite" => $onePerm['members_write'],
                "membersAdd" => $onePerm['members_add'],
                "membersProductsAdd" => $onePerm['members_products_add'],
                "membersPaymentSchedulesRead" => $onePerm['members_payment_schedules_read'],
                "membersStatistiquesRead" => $onePerm['members_statistiques_read'],
                "membersSubscriptionRead" => $onePerm['members_subscription_read'],
                "paymentSchedulesRead" => $onePerm['payment_schedules_read'],
                "paymentSchedulesWrite" => $onePerm['payment_schedules_write'],
                "paymentDayRead" => $onePerm['payment_day_read'],
                "salle" => [
                    "salleId" => $onePerm['salle_id'],
                    "clientId" => $onePerm['client_id'],
                    "SalleName" => $onePerm['salle_name'],
                    "SalleAddress" => $onePerm['salle_address'],
                ],
                "grants" => [
                    "grantsId" => $onePerm['grants_id'],
                    "permsId" => $onePerm['perms_id'],
                    "clientId" => $onePerm['client_id'],
                    "salleId" => $onePerm['salle_id'],
                    "perms" => $onePerm['perms'],
                    "salleActive" => $onePerm['active'],
                ],
            ];
        }
        // echo "<pre>";
        // print_r($permTab);
        // echo "</pre>";
        return self::sendJSON($permTab);
    }

    
    public function sendJSON($info){
        
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: Application/json");
        echo json_encode($info);
    }
}