<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Client.php';


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$client = new Client($db);

// Blog post query
$result = $client->getDBClients();




$client_results = $client::formatDataClients($result);

echo json_encode($client_results);

