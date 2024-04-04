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
                                        WHERE u.idConsultation = :id");
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

        // Requête pour ajouter une consultation
        $query = $linkpdo->prepare("INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) 
            VALUES (:date_consult, :heure_consult, :duree_consult, :id_medecin, :id_usager)");

        
        // Bind des paramètres
        $date = $data['date_consult'];
        $query->bindParam(':date_consult', $date);

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

        // Requête pour mettre à jour une consultation
        $query = $linkpdo->prepare("INSERT INTO consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) 
            VALUES (:date_consult, :heure_consult, :duree_consult, :id_medecin, :id_usager)");

        // Bind des paramètres
        $date = $data['date_consult'];
        $query->bindParam(':date_consult', $date);

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

    // Fonction pour supprimer une consultation
    function delConsultation(int $id){
        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour supprimer une consultation
        $query = $linkpdo->prepare("DELETE FROM consultation WHERE idConsultation = :id");

        $query->bindParam(':id', $id);
        $query->execute();

        // Retourne les données
        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }
    
?>