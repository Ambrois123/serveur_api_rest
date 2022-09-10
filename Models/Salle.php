<?php
/**
 * class salle
 */ 

 class Salle{

    private $conn;
    private $table = 'api_salle';
    /**
     * construct with db
     */
    public function __construct($db) {

        $this->conn = $db;
    }
    /**
     * recup data salle
     */
    public function getDBSalles(){
        $req = "SELECT * from " .$this->table ." 
        s INNER JOIN Api_zone z  ON z.salle_id = s.salle_id
        INNER JOIN Api_branch b ON b.salle_id = s.salle_id
        INNER JOIN Api_install_perms p ON p.salle_id = s .salle_id";
        
        $statement = $this->conn->prepare($req);
        $statement->execute();
        $salles = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        return $salles;
    }

    /**
     * connexion one salle
     */

    public function getDBOneSalle($idSalle)
    {
        $req = "SELECT * from" .$this->table . " 
        INNER JOIN Api_zone z ON z.salle_id = s.salle_id
        INNER JOIN Api_branch b ON b.salle_id = b.salle_id
        INNER JOIN Api_install_perms p ON p.salle_id = s.salle_id
        s WHERE s.salle_id = :idSalle
        ";
        $statement = $this->conn->prepare($req);
        $statement->bindValue(":idSalle", $idSalle, PDO::PARAM_INT);
        $statement->execute();
        $oneSalle = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        return $oneSalle;
    }
     /**
     * format data
     * 
     */

    public static function formatDataSalle($bySalle){

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

    public static function formatDataSalles($bySalles){
        $salleTab = [];
        foreach($bySalles as $bySalle){
      
            $salleTab [] = salle::formatDataSalles($bySalles);
            
        }
        // echo "<pre>";
        // print_r($clientTab);
        // echo "</pre>";
         return $salleTab;
      }

 }

