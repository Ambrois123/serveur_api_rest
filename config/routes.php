<?php
/**
 * 
 * The route array defines the route of this rest api.
 * It structure is as follow
 * [
 *  "path" => [
 *      "requestMethod" => ["class", "function"]
 *  ]
 * ]
 */
return [
    "clients" =>  
    [
       
            "GET" => [
                "class" => "ClientController",
                "function" => "getClients"
        ],
        /* Not used for the moment
        "POST" => [
            "class" => "ClientController",
            "function" => "postClients"
        ],
        */
       
    ],

    "client" =>
    [
        
        "GET" => [
            "class" => "ClientController",
            "function" => "getClient"
        ],
         /* Not used for the moment
        "POST" => [
            "class" => "ClientController",
            "function" => "postClient"
        ],
        */
       
    ],
    "salles" =>  
    [
       
            "GET" => [
                "class" => "SalleController",
                "function" => "getSalles"
        ],
        /* Not used for the moment
        "POST" => [
            "class" => "ClientController",
            "function" => "postClients"
        ],
        */
       
    ],
    "salle" =>
    [
        
        "GET" => [
            "class" => "SalleController",
            "function" => "getSalle"
        ],
         /* Not used for the moment
        "POST" => [
            "class" => "ClientController",
            "function" => "postClient"
        ],
        */
       
    ],
    "offers" =>
    [
        
        "GET" => [
            "class" => "OfferController",
            "function" => "getOffers"
        ],
         /* Not used for the moment
        "POST" => [
            "class" => "ClientController",
            "function" => "postClient"
        ],
        */
       
    ],
    "offer" =>
    [
        
        "GET" => [
            "class" => "OfferController",
            "function" => "getOffers"
        ],
         /* Not used for the moment
        "POST" => [
            "class" => "ClientController",
            "function" => "postClient"
        ],
        */
       
    ],
];