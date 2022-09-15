<?php
 define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
 "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

 //require the controllers
 foreach (scandir("Controllers") as $filename) {
    $path = 'Controllers/' . $filename;
    if (is_file($path)) {
        require $path;
    }
}

 $routes = require_once __DIR__.'/config/routes.php';


 try{
    if(empty($_GET['page'])){
        throw new Exception("Page n'existe pas");
     }else{
        $url = explode("/",filter_var($_GET['page'], FILTER_SANITIZE_URL));
        if(empty($url[0]) ) throw new Exception ("La page n'existe pas!!!");
         {
            //get the request path and the method
            $requestPath = $url[0];
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            
            if(isset($routes[$requestPath][ $requestMethod ])){
                //get the route given the request path and the method. 
                $route = $routes[$requestPath][ $requestMethod ];

                $className = $route['class'];
                $functionName = $route['function'];
                
                $controller = new $className();
                
                //execute the request. If the request has more parameter
                if(empty($url[1])){
                    $controller->$functionName();
                }else{
                    $controller->$functionName($url[1]);
                }
                
                
            }else{
                header("HTTP/1.1 404 Not Found");
                
            }
                
        }
     }
    }catch (Exception $e){
        $msg = $e->getMessage();
        //TODO: send request param error
         header("HTTP/1.1 404 Not Found");
         $outPut = array("message" => $msg);
        echo json_encode($outPut);
    }
 























 
//  try{
//     if(empty($_GET['page'])){
//         throw new Exception("La page n'existe pas");
//     }else{
//         $url = explode("/",filter_var($_GET['page'], FILTER_SANITIZE_URL));
//         if(empty($url[0]) || empty($url[1])) throw new Exception ("La page n'existe pas");
//         switch($url[0]){
//             case "front" : 
//                     switch($url[1]){
//                         case "partenaires" : $apiController -> getPartenaires();
//                         break;
//                         case "partenaire" : 
//                             if(empty($url[2])) throw new Exception("Identifiant du partenaire est manquant");
//                             $apiController -> getPartenaire($url[2]);
//                         break;
//                         case "salles" : $apiController -> getSalle();
//                         break;
//                         case "formulaire" : $apiController -> getFormulaire();
//                         break;
//                         default : throw new Exception("La page n'existe pas");
//                     }
//             break;
//             case "back" : echo "page back end demandée";
//             break;
//             default : throw new Exception("La page n'existe pas");
//         }
//     }
// }catch (Exception $e){
//     $msg = $e->getMessage();
//     echo $msg;
// }