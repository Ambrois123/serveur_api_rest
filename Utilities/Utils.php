<?php

Class Util{
    public static function sendJSON($info){
        
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: Application/json");
        echo json_encode($info);
    }
}