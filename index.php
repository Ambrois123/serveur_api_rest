<?php
 define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
 "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

 require_once "APIController.php";
 $apiController = new APIController();

 try{
    if(empty($_GET['page'])){
        throw new Exception("Page n'existe pas");
     }else{
        $url = explode("/",filter_var($_GET['page'], FILTER_SANITIZE_URL));
        if(empty($url[0]) ) throw new Exception ("La page n'existe pas!!!".$url[0]);
         {
                switch($url[0]){
                    case "clients" : $apiController->getClients();
                    break;
                    case "client" : 
                        if(empty($url[1])) throw new Exception ("ID manquant");
                        $apiController->getOneClient($url[1]);
                    break;
                    case "salles" : $apiController ->getSalles();
                    break;
                    case "salle"  : 
                        if(empty($url[1])) throw new Exception ("ID manquant");
                        $apiController->getOneSalle($url[1]);
                    break;
                    case "perms" : $apiController ->getPerms();
                    break;
                    default : throw new Exception("La page n'existe pas");
                }
        }
     }
    }catch (Exception $e){
        $msg = $e->getMessage();
        echo $msg;
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