<?php

/**
 * Undocumented class
 */
class Offer
{
  private $conn;
  private $table = 'api_offers';

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }
 /**
     * recup data clients
     */
  public function getDBOffers()
  {
    $req = "SELECT * from " . $this->table;

    $statement = $this->conn->prepare($req);
    $statement->execute();
    $offers = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $offers;
  }
 /**
     * connexion one client
     */
  public function getDBOneOffer($idOffer)
  {
    $req = "SELECT * from " . $this->table . " o WHERE o.aut_id = :idOffer";
    $statement = $this->conn->prepare($req);
    $statement->bindValue(":idOffer", $idOffer, PDO::PARAM_INT);
    $statement->execute();
    $oneOffer = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $oneOffer;
  }
  
}
