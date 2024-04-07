<?php

    require_once './functions/medecinsFunctions.php';
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

                //Si l'id est set : on le récupère et récupère le medecin correspondant
                if(isset($_GET['id'])){

                    //Récupération de l'id
                    $id=htmlspecialchars($_GET['id']);

                    //Appel de la fonction pour récupérer le medecin correspondant à l'id
                    $matchingData=getMedecin($id);

                //Si l'id n'est pas set : on récupère toutes les données
                } else {

                    //Appel de la fonction pour récupérer tous les medecins
                    $matchingData=getAllMedecin();
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
                    
                    //Ajoût de le medecin
                    $matchingData=addMedecin($data);

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

                        // Fonction pour mettre à jour le medecin
                        $success=updateMedecin($_GET['id'],$data);

                        if (!$success){
                            deliver_response(404, "Not Found");
                        } else {
                            deliver_response(200, "OK");
                        }
                    } else {
                        deliver_response(400, "Bad Request");
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

                        // Fonction pour mettre à jour le medecin
                        $success=updateMedecin($_GET['id'],$data);

                        if (!$success){
                            deliver_response(404, "Not Found");
                        } else {
                            deliver_response(200, "OK");
                        }
                    } else {
                        deliver_response(400, "Bad Request");
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

                        // Fonction pour supprimer le medecin
                        $success=delMedecin($_GET['id']);

                        if (!$success){
                            deliver_response(404, "Not Found");
                        } else {
                            deliver_response(200, "OK");
                        }
                    } else {
                        deliver_response(400, "Bad Request");
                    }
                } catch (Exception $e){
                    deliver_response(403, "Forbidden");
                }
            break;
        }
    }
?>