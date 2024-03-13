<?php

    include 'usagerFunctions.php';

    //Connexion
    $server = "localhost";
    $db = "cabinetmedical";
    $login = "root";
    $mdp = "";

    $connexion = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);



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
            $data_init = getUsager($_GET['id']);
            $data = json_decode($postedData,true); //Reçoit du json et renvoi une adaptation exploitable en php. Le paramètre true impose un tableau en retour et non un objet.
            
            foreach($data as $key => $value){
                if($value==null){
                    $data_init[$key][$value]=$data[$key][$value];
                }
            }

            //Traitement des données
            $matchingData=updateUsager($_GET['id'],$data_init);
            if (empty($matchingData)){
                deliver_response(404, "Not Found");
            } else {
                deliver_response(200, "OK", $matchingData);
            }
        break;
        case "PUT" :
            // Récupération des données dans le corps
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData,true); //Reçoit du json et renvoi une adaptation exploitable en php. Le paramètre true impose un tableau en retour et non un objet.
            
            //Traitement des données
            if (isset($_GET['id'])){
                $matchingData=updateUsager($_GET['id'],$data);
                if (empty($matchingData)){
                    deliver_response(404, "Not Found");
                } else {
                    deliver_response(200, "OK", $matchingData);
                }
            } else {
                deliver_response(400, "Bad Request");
            }
        break;
        case "DELETE" :
            //Traitement des données
            if (isset($_GET['id'])){
                $matchingData=delUsager($_GET['id']);
                if (empty($matchingData)){
                    deliver_response(404, "Not Found");
                } else {
                    deliver_response(200, "OK", $matchingData);
                }
            } else {
                deliver_response(400, "Bad Request");
            }
    }
?>