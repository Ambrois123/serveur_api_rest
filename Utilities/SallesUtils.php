<?php

class SalleUtils{
     /**
     * format data
     * 
     */
    public static function formatDataSalle($bySalle){

        $salleTab = array(
            
                    "salleid" => $bySalle['salle_id'],
                    "sallename" => $bySalle['salle_name'], 
                    "salleaddress"=>$bySalle['salle_address'],
                    "sallezone" => $bySalle['salle_zone'], 
                    "sallebranch" => $bySalle['salle_branch'],
                    "clientid" => $bySalle['client_id'],
            "Offres" => array(
                      "offreId" => $bySalle['perms_id'],
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
            ),
                  "Options" => array(
                        "grantsid" => $bySalle['grants_id'], 
                        "Garantie-choisie" => $bySalle['perms'],
                        "salleactive" => $bySalle['active'] 
                  ),
            );
        return $salleTab;
    }

    public static function formatDataSalles($bySalles){
        $salleTab = [];
        foreach($bySalles as $bySalle){
      
            $salleTab [] = SalleUtils::formatDataSalle($bySalle);
            
        }
        // echo "<pre>";
        // print_r($clientTab);
        // echo "</pre>";
         return $salleTab;
      }
}