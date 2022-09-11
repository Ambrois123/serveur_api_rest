<?php
abstract class BaseController 
{
    
    protected  function sendJSON($info){
        
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: Application/json");
        echo json_encode($info);
    }

    protected function sendNotFound(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: Application/json");
        header("HTTP/1.1 404 Not Found");
        exit();

    }
}
