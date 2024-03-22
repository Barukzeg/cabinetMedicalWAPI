<?php

    require_once './functions/statistiqueFunctions.php';
    require_once './functions/response.php';

    /// Identification du type de méthode HTTP envoyée par le client
    $http_method = $_SERVER['REQUEST_METHOD'];

    switch ($http_method){

        // Si la méthode est GET (récupération de données)
        case "GET" :

            //Si l'id est set : on le récupère et récupère le type de statistique correspondant
            if(isset($_GET['id'])){

                //Récupération de l'id
                $id=htmlspecialchars($_GET['id']);

                //Appel de la fonction pour récupérer le type de statistiques correspondant à l'id
                $matchingData=getStats($id);
            }

            //Envoi de la réponse
            if (empty($matchingData)){
                deliver_response(404, "Not Found");
            } else {
                deliver_response(200, "OK", $matchingData);
            }

            break;
        default:
            deliver_response(400, "Bad Request");
            break;
    }
?>