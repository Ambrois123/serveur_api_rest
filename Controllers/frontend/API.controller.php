<?php

require_once "Models/frontend/API.Manager.php";
require_once "Models/Model.php";

class APIController{
    private $apiManager;

    public function __construct(){
        $this->apiManager = new APIManager();
    }
    public function getClients(){
        $clients = $this->apiManager->getDBClients();
        Model::sendJSON($this->formatDataClients($clients));
        
    }
    public function getOneClient($idClient){
        $oneClient = $this->apiManager->getDBOneClient($idClient);
        Model::sendJSON($this->formatDataClients($oneClient));
    }

    private function formatDataClients($byClients){
        $clientTab = [];
        foreach($byClients as $byClient){
            $clientTab[] =[
                "clientId" => $byClient['client_id'],
                "clientName" => $byClient['client_name'],
                "clientSlogan" => $byClient['client_secret'],
                "clientEmail" => $byClient['client_email'],
                "clientAdresse" => $byClient['client_address'],
                "clientActive" => $byClient['active'],
                "shortDescription" => $byClient['short_description'],
                "fullDescription" => $byClient['full_description'],
                "clientLogo" => $byClient['logo_url'],
                "clientUrl" => $byClient['client_url'],
                "déléguéProtection" => $byClient['dpo'],
                "contactTechnique" => $byClient['technical_contact'],
                "contactCommercial" => $byClient['commercial_contact']
            ];
        }
        // echo "<pre>";
        // print_r($clientTab);
        // echo "</pre>";
         return $clientTab;
    }
    
    public function getSalles(){
       
        $salles = $this->apiManager->getDBSalles();
        Model::sendJSON($this->formatDataSalles($salles));
    }
    public function getOneSalle($idSalle){
        $oneSalle = $this->apiManager->getDBOneSalle($idSalle);
        Model::sendJSON($this->formatDataSalles($oneSalle));
    }

    private function formatDataSalles($bySalles){
        $tab = [];
        foreach($bySalles as $bySalle){
            $tab[$bySalle['salle_name']] = [
                "salleId" => $bySalle['salle_id'],
                "clientId" => $bySalle['client_id'],
                "SalleName" => $bySalle['salle_name'],
                "SalleAddress" => $bySalle['salle_address'],
                "zone" => [
                    "zoneId" => $bySalle['zone_id'],
                    "salleId" => $bySalle['salle_id'],
                    "zone name" => $bySalle['zone_name'],
                    "branch" => [
                        "branchId" => $bySalle['branch_id'],
                        "salleId" => $bySalle['salle_id'],
                        "branchName" => $bySalle['branch_name'],
                        "Perms" => [
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
                            "paymentDayRead" => $bySalle['payment_day_read'],
                        ]
                    ]
                ]
            ];
        }
        // echo "<pre>";
        // print_r($tab);
        // echo "</pre>";
        return $tab;
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