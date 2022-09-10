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
 /**
     * recup data clients
     */
  public function getDBClients()
  {
    $req = "SELECT * from " . $this->table;

    $statement = $this->conn->prepare($req);
    $statement->execute();
    $clients = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $clients;
  }
 /**
     * connexion one client
     */
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
  
}
