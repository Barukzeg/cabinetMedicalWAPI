<?php

    require_once './functions/usagersFunctions.php';
    require_once './functions/response.php';

    /// Identification du type de méthode HTTP envoyée par le client
    $http_method = $_SERVER['REQUEST_METHOD'];

    switch ($http_method){
        case "GET" :
            //Récupération des données dans l’URL si nécessaire
            if(isset($_GET['id'])){
                $id=htmlspecialchars($_GET['id']);
                //Traitement des données
                $matchingData=getUsager($id);
            } else {
                //Appel de la fonction de lecture des phrases
                $matchingData=getAllUsager();
            }
            //Envoi de la réponse
            if (empty($matchingData)){
                deliver_response(404, "Not Found");
            } else {
                deliver_response(200, "OK", $matchingData);
            }

        break;
        case "POST" :
            // Récupération des données dans le corps
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData,true); //Reçoit du json et renvoi une adaptation exploitable en php. Le paramètre true impose un tableau en retour et non un objet.
            
            //Traitement des données
            $matchingData=addUsager($data);

            deliver_response(201, "Created", $matchingData);

        break;
        case "PATCH" :
            // Récupération des données dans le corps
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData,true); //Reçoit du json et renvoi une adaptation exploitable en php. Le paramètre true impose un tableau en retour et non un objet.
            
            //Traitement des données
            if (isset($_GET['id'])){
                $success=updateUsager($_GET['id'],$data);
                if (!$success){
                    deliver_response(404, "Not Found");
                } else {
                    deliver_response(200, "OK");
                }
            } else {
                deliver_response(400, "The 'id' is missing");
            }
        break;
        case "PUT" :
            // Récupération des données dans le corps
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData,true); //Reçoit du json et renvoi une adaptation exploitable en php. Le paramètre true impose un tableau en retour et non un objet.
            
            //Traitement des données
            if (isset($_GET['id'])){
                $success=updateUsager($_GET['id'],$data);
                if (!$success){
                    deliver_response(404, "Not Found");
                } else {
                    deliver_response(200, "OK");
                }
            } else {
                deliver_response(400, "The 'id' is missing");
            }
        break;
        case "DELETE" :
            //Traitement des données
            if (isset($_GET['id'])){
                $success=delUsager($_GET['id']);
                if (!$success){
                    deliver_response(404, "Not Found");
                } else {
                    deliver_response(200, "OK");
                }
            } else {
                deliver_response(400, "The 'id' is missing");
            }
        break;
    }
?>