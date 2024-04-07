<?php

    require_once('../bd/bdd.php');

    // Fonction pour récupérer toutes les consultations
    function getAllConsultation(){
        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour récupérer tous les usagers
        $query = $linkpdo->prepare("SELECT * FROM consultation;");
        $query->execute();

        // Retourne les données
        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    // Fonction pour récupérer une consultation
    function getConsultation(int $id){
        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour récupérer une consultation
        $query = $linkpdo->prepare("SELECT u.* 
                                        FROM consultation u 
                                        WHERE u.id_consult = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        // Retourne les données
        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    // Fonction pour ajouter une consultation
    function addConsultation($data) {
        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        $date = DateTime::createFromFormat('d/m/y', $data['date_consult']);
        $formattedDate = $date->format('Y-m-d');

        // Requête pour ajouter une consultation
        $query = $linkpdo->prepare("INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) 
            VALUES (:date_consult, :heure_consult, :duree_consult, :id_medecin, :id_usager)");

        
        // Bind des paramètres
        $query->bindParam(':date_consult', $formattedDate);

        $heure = $data['heure_consult'];
        $query->bindParam(':heure_consult', $heure);

        $duree = $data['duree_consult'];
        $query->bindParam(':duree_consult', $duree);

        $idMedecin = $data['id_medecin'];
        $query->bindParam(':id_medecin', $idMedecin);

        $idUsager = $data['id_usager'];
        $query->bindParam(':id_usager', $idUsager);

        $query->execute();

        // Retourne les données
        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    // Fonction pour mettre à jour une consultation
    function updateConsultation(int $id, $data){
        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();
        
        try {
            // Récupération des données de la consultation à modifier
            $get = getConsultation($id);

            if (empty($get)) {
                return false;
            }
            
            // Mise à jour des données grâce aux données reçues
            foreach ($get as $key => $value) {
                if (!isset($data[$key])) {
                    $data[$key] = $value;
                }
            }

            // Requête pour mettre à jour une consultation
            $query = $linkpdo->prepare("UPDATE consultation
                                        SET date_consult = :date_consult, 
                                            heure_consult = :heure_consult, 
                                            duree_consult = :duree_consult, 
                                            id_medecin = :id_medecin, 
                                            id_usager = :id_usager
                                        WHERE id_consult = :id_consult");

            // Bind des paramètres
            $query->bindParam(':id_consult', $id);

            $date = DateTime::createFromFormat('d/m/y', $data['date_consult']);
            $formattedDate = $date->format('Y-m-d');
            $query->bindParam(':date_consult', $formattedDate);

            $heure = $data['heure_consult'];
            $query->bindParam(':heure_consult', $heure);

            $duree = $data['duree_consult'];
            $query->bindParam(':duree_consult', $duree);

            $idMedecin = $data['id_medecin'];
            $query->bindParam(':id_medecin', $idMedecin);

            $idUsager = $data['id_usager'];
            $query->bindParam(':id_usager', $idUsager);

            $update = $query->execute();

            $success = $update;
        
            // Retourne le résultat
            return $success;

        } catch (PDOException $e) {
            die("Erreur de mise à jour dans la base de données: " . $e->getMessage());
        }
    }

    // Fonction pour supprimer une consultation
    function delConsultation(int $id){
        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour supprimer une consultation
        $query = $linkpdo->prepare("DELETE FROM consultation WHERE id_consult = :id");

        $query->bindParam(':id', $id);
        $success = $query->execute();

        // Retourne les données
        return $success;
    }
    
?>