<?php
error_reporting(0);
Class OfferUtils{
    public static function formatDataOffer($byOffer){
        
        $offerTab = array(

            "offerid" => $byOffer['aut_id'],
            "membersRead" => $byOffer['members_read'],
            "membersWrite" => $byOffer['members_write'],
            "membersAdd" => $byOffer['members_add'],
            "membersProductsAdd" => $byOffer['members_products_add'],
            "membersPaymentSchedulesRead" => $byOffer['members_payment_schedules_read'],
            "membersStatistiquesRead" => $byOffer['members_statistiques_read'],
            "membersSubscriptionSead" => $byOffer['members_subscription_read'],
            "paymentSchedulesRead" => $byOffer['payment_schedules_read'],
            "paymentSchedulesWrite" => $byOffer['payment_schedules_write'],
            "paymentDayRead" => $byOffer['payment_day_read'],
        
        ) ;
        
         return $offerTab;
    }

    public static function formatDataOffers($byOffers){
        $offerTab = [];
        foreach($byOffers as $byOffer){
      
            $offerTab [] = OfferUtils::formatDataOffer($byOffer);
            
        }
       
         return $offerTab;
      }
}