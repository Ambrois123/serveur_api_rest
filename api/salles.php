<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Salle.php';


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$salle = new salle($db);

// Blog post query
$result = $salle->getDBSalles();



$salle_results = $salle::formatDataSalles($result);

echo json_encode($salle_results );