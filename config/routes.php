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
];