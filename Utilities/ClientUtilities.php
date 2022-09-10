<?php

Class ClientUtilities{
    public static function formatDataClient($byClient){
        
        $clientTab = array(
            
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
        
        ) ;
        
         return $clientTab;
    }

    public static function formatDataClients($byClients){
        $clientTab = [];
        foreach($byClients as $byClient){
      
            $clientTab [] = ClientUtilities::formatDataClient($byClient);
            
        }
        // echo "<pre>";
        // print_r($clientTab);
        // echo "</pre>";
         return $clientTab;
      }
}