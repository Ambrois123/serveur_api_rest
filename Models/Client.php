<?php

/**
 * Undocumented class
 */
class Client
{
  private $conn;
  private $table = 'api_client';

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function getDBClients()
  {
    $req = "SELECT * from " . $this->table;

    $statement = $this->conn->prepare($req);
    $statement->execute();
    $clients = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $clients;
  }

  public function getDBOneClient($idClient)
  {
    $req = "SELECT * from " . $this->table . " c WHERE c.client_id = :idClient";
    $statement = $this->conn->prepare($req);
    $statement->bindValue(":idClient", $idClient, PDO::PARAM_INT);
    $statement->execute();
    $oneClient = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $oneClient;
  }

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
    
    // echo "<pre>";
    // print_r($clientTab);
    // echo "</pre>";
     return $clientTab;
}

public static function formatDataClients($byClients){
  $clientTab = [];
  foreach($byClients as $byClient){

      $clientTab [] = Client::formatDataClient($byClient);
      
  }
  // echo "<pre>";
  // print_r($clientTab);
  // echo "</pre>";
   return $clientTab;
}
}
