<?php
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

    function is_valid($token){

        $url = 'https://authwapi.alwaysdata.net/auths';

        $headers = array(
            'Content-Type: application/json',
            'token' . $token
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
?>