<?php

    require_once './functions/consultationsFunctions.php';
    require_once './functions/response.php';

    //Vérification de l'authentification
    $token = get_bearer_token();
    
    if ($token === null || !is_valid($token)) {

        deliver_response(401, "Unauthorized");
        exit();

    } else {

        // Identification du type de méthode HTTP envoyée par le client
        $http_method = $_SERVER['REQUEST_METHOD'];

        switch ($http_method){

            // Si la méthode est GET (récupération de données)
            case "GET" :

                //Si l'id est set : on le récupère et récupère l'consultation correspondant
                if(isset($_GET['id'])){

                    //Récupération de l'id
                    $id=htmlspecialchars($_GET['id']);

                    //Appel de la fonction pour récupérer l'consultation correspondant à l'id
                    $matchingData=getConsultation($id);

                //Si l'id n'est pas set : on récupère toutes les données
                } else {

                    //Appel de la fonction pour récupérer tous les consultations
                    $matchingData=getAllConsultation();
                }

                //Envoi de la réponse
                if (empty($matchingData)){
                    deliver_response(404, "Not Found");
                } else {
                    deliver_response(200, "OK", $matchingData);
                }

            break;

            // Si la méthode est POST (création de données)
            case "POST" :

                try{
                    // Récupération des données dans le corps
                    $postedData = file_get_contents('php://input');

                    //Transforme le json reçu en array (d'ou le 'true') exploitable en php
                    $data = json_decode($postedData,true);
                    
                    //Ajoût de l'consultation
                    $matchingData=addConsultation($data);

                    //Envoi de la réponse
                    deliver_response(201, "Created", $matchingData);
                } catch (Exception $e){
                    deliver_response(403, "Forbidden");
                }

            break;

            // Si la méthode est PATCH (mise à jour de données partielles))
            case "PATCH" :

                try{
                    // Récupération des données dans le corps
                    $postedData = file_get_contents('php://input');

                    //Transforme le json reçu en array (d'ou le 'true') exploitable en php
                    $data = json_decode($postedData,true);
                    
                    //Traitement des données
                    if (isset($_GET['id'])){

                        // Fonction pour mettre à jour l'consultation
                        $success=updateConsultation($_GET['id'],$data);

                        if (!$success){
                            deliver_response(404, "Not Found");
                        } else {
                            deliver_response(200, "OK");
                        }
                    } else {
                        deliver_response(400, "Bad request");
                    }
                } catch (Exception $e){
                    deliver_response(403, "Forbidden");
                }

            break;

            // Si la méthode est PUT (mise à jour de données complètes)
            case "PUT" :

                try{
                    // Récupération des données dans le corps
                    $postedData = file_get_contents('php://input');
                    
                    //Transforme le json reçu en array (d'ou le 'true') exploitable en php
                    $data = json_decode($postedData,true);
                    
                    //Traitement des données
                    if (isset($_GET['id'])){

                        // Fonction pour mettre à jour l'consultation
                        $success=updateConsultation($_GET['id'],$data);

                        if (!$success){
                            deliver_response(404, "Not Found");
                        } else {
                            deliver_response(200, "OK");
                        }
                    } else {
                        deliver_response(400, "Bad request");
                    }                
                } catch (Exception $e){
                    deliver_response(403, "Forbidden");
                }

            break;

            // Si la méthode est DELETE (suppression de données)
            case "DELETE" :

                try{
                    //Traitement des données
                    if (isset($_GET['id'])){

                        // Fonction pour supprimer l'consultation
                        $success=delConsultation($_GET['id']);

                        deliver_response(200, "OK");
                    } else {
                        deliver_response(400, "Bad request");
                    }
                } catch (Exception $e){
                    deliver_response(403, "Forbidden");
                }
            break;
        }
    }
?>