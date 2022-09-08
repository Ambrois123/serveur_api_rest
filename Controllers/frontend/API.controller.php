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
                "client-id" => $byClient['client_id'],
                "client-name" => $byClient['client_name'],
                "client-slogan" => $byClient['client_secret'],
                "client-email" => $byClient['client_email'],
                "client-adresse" => $byClient['client_address'],
                "client-active" => $byClient['active'],
                "short description" => $byClient['short_description'],
                "full description" => $byClient['full_description'],
                "logo" => $byClient['logo_url'],
                "client-url" => $byClient['client_url'],
                "délégué protection" => $byClient['dpo'],
                "contact technique" => $byClient['technical_contact'],
                "contact commercial" => $byClient['commercial_contact']
            ];
        }
        echo "<pre>";
        print_r($clientTab);
        echo "</pre>";
        // return $clientTab;
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
                "salle-id" => $bySalle['salle_id'],
                "client-id" => $bySalle['client_id'],
                "Salle name" => $bySalle['salle_name'],
                "Salle address" => $bySalle['salle_address'],
                "zone" => [
                    "zone-id" => $bySalle['zone_id'],
                    "salle-id" => $bySalle['salle_id'],
                    "zone name" => $bySalle['zone_name'],
                    "branch" => [
                        "branch-id" => $bySalle['branch_id'],
                        "salle-id" => $bySalle['salle_id'],
                        "branch name" => $bySalle['branch_name'],
                        "Perms" => [
                            "perms-id" => $bySalle['perms_id'],
                            "salle-id" => $bySalle['salle_id'],
                            "members read" => $bySalle['members_read'],
                            "members write" => $bySalle['members_write'],
                            "members add" => $bySalle['members_add'],
                            "members products add" => $bySalle['members_products_add'],
                            "members payment_schedules_read" => $bySalle['members_payment_schedules_read'],
                            "members statistiques read" => $bySalle['members_statistiques_read'],
                            "members subscription_read" => $bySalle['members_subscription_read'],
                            "payment schedules_read" => $bySalle['payment_schedules_read'],
                            "payment schedules_write" => $bySalle['payment_schedules_write'],
                            "payment day_read" => $bySalle['payment_day_read'],
                        ]
                    ]
                ]
            ];
        }
        echo "<pre>";
        print_r($tab);
        echo "</pre>";
        // return $tab;
    }


    public function getPerms(){
        $perms = $this->apiManager->getDBPerms();
        Model::sendJSON($this->formatDataPerms($perms));
    }

    private function formatDataPerms($onePerms){
        $permTab = [];
        foreach($onePerms as $onePerm){
            $permTab["Salle_".$onePerm['salle_id']] =[
                "perms-id" => $onePerm['perms_id'],
                "salle-id" => $onePerm['salle_id'],
                "members read" => $onePerm['members_read'],
                "members write" => $onePerm['members_write'],
                "members add" => $onePerm['members_add'],
                "members products add" => $onePerm['members_products_add'],
                "members payment_schedules_read" => $onePerm['members_payment_schedules_read'],
                "members statistiques read" => $onePerm['members_statistiques_read'],
                "members subscription_read" => $onePerm['members_subscription_read'],
                "payment schedules_read" => $onePerm['payment_schedules_read'],
                "payment schedules_write" => $onePerm['payment_schedules_write'],
                "payment day_read" => $onePerm['payment_day_read'],
                "salle" => [
                    "salle-id" => $onePerm['salle_id'],
                    "client-id" => $onePerm['client_id'],
                    "Salle name" => $onePerm['salle_name'],
                    "Salle address" => $onePerm['salle_address'],
                ],
                "grants" => [
                    "grants-id" => $onePerm['grants_id'],
                    "perms-id" => $onePerm['perms_id'],
                    "client-id" => $onePerm['client_id'],
                    "salle-id" => $onePerm['salle_id'],
                    "perms" => $onePerm['perms'],
                    "salle active" => $onePerm['active'],
                ],
            ];
        }
        echo "<pre>";
        print_r($permTab);
        echo "</pre>";
        // return $permTab;
    }
    
}