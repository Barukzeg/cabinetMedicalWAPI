<?php

    require_once "jwt_utils.php";
    
    $server = "localhost";
    $db = "cabinetmedical_auth";
    $login = "root";
    $mdp = "";
        
    //Connexion à la base de données
    try {
        $connexion = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    //Recuperation de la methode POST pour l'envoie du token
    $http_method = $_SERVER['REQUEST_METHOD'];
    if ($http_method == "POST") {

        //Recuperation du corps de la requete
        $postedData = file_get_contents('php://input');
        $data = json_decode($postedData,true);

        //Verification de la presence des données
        if (!isset($data['login']) || !isset($data['mdp'])) {
            deliver_response(400, "Bad Request");
        } else {

            //Recuperation des données
            $login = $data['login'];
            $password = $data['mdp'];

            //Verification du login et du mot de passe
            $query = "SELECT count(*) FROM user_auth WHERE login = :login AND mdp = :password";
            $stmt = $connexion->prepare($query);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch();
            $count = $result[0];

            //Identifiants corrects
            if($count>=1){

                //Creation du token
                $headers = array(
                    "alg" => "HS256",
                    "typ" => "JWT"
                );

                $payload = array(
                    "login" => $login,
                    "exp" => time() + 3600
                );

                $secret = "secret";

                $token = generate_jwt($headers, $payload, $secret);

                //Envoi de la reponse et du token
                deliver_response(200, "CabinetMedical_AUTH : Authentification OK", $token);

            //Sinon renvoie de l'erreur "Unauthorized"
            }else{
                deliver_response(401, "Unauthorized");
            }
        }

    } else if ($http_method == "GET") {

        //Recuperation du token
        $token = $_SERVER['HTTP_TOKEN'];

        //Verification de la presence du token
        if (!isset($token)) {
            deliver_response(400, "Bad Request");
        } else {

            //Verification du token
            $secret = "secret";
            $payload = is_jwt_valid($token, $secret);

            //Token valide
            if ($payload != null) {
                deliver_response(200, "CabinetMedical_AUTH : Token OK", $payload);
            //Token invalide
            } else {
                deliver_response(401, "Unauthorized");
            }
        }

    } else {

        //Methode non autorisée (autre que POST)
        deliver_response(400, "Bad Request");
    }

    //Fonction de renvoie de la reponse
    function deliver_response($status_code, $status_message, $data=null){
        // var_dump($data);
        $json_response = json_encode($data);
        if($json_response===false)
        die('json encode ERROR : '.json_last_error_msg());
        /// Paramétrage de l'entête HTTP
        http_response_code($status_code); //Utilise un message standardisé en fonction du code HTTP
        //header("HTTP/1.1 $status_code $status_message"); //Permet de personnaliser le message associé au code HTTP
        header("Content-Type:application/json; charset=utf-8");//Indique au client le format de la réponse
        $response['status_code'] = $status_code;
        $response['status_message'] = $status_message;
        $response['data'] = $data;
        /// Mapping de la réponse au format JSON
        $json_response = json_encode($response);
        if($json_response===false)
        die('json encode ERROR : '.json_last_error_msg());
        /// Affichage de la réponse (Retourné au client)
        echo $json_response;
    }