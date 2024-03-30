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
            'Authorization: Bearer ' . $token
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $responseJson = json_decode($response, true);
    
        if (!isset($responseJson['status_code']) || $responseJson['status_code'] != 200) {
            return false;
        }
        return $responseJson['status_code'] == 200;
    }

    function get_bearer_token() {
        
        $headers = get_authorization_header();

        if (!empty($headers)) {

            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {

                if($matches[1]=='null')
                    return null;
                else
                    return $matches[1];
            }
        }
        return null;
    }

    function get_authorization_header(){
        $headers = null;
    
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
    
        return $headers;
    }
?>