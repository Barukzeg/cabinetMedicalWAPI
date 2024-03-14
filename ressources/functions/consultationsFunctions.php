<?php

    require_once('../bd/bdd.php');

    function getAllConsultation(){
        $linkpdo = BDD::getBDD()->getConnection();
        $query = $linkpdo->prepare("SELECT * FROM Consultation;");
        $query->execute();
        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function getConsultation(int $id){
        $linkpdo = BDD::getBDD()->getConnection();
        $query = $linkpdo->prepare("SELECT u.* 
                                        FROM Consultation u 
                                        WHERE u.idConsultation = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function addConsultation($data) {
        $linkpdo = BDD::getBDD()->getConnection();

        $query = $linkpdo->prepare("INSERT INTO Consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) 
            VALUES (:date_consult, :heure_consult, :duree_consult, :id_medecin, :id_usager)");

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

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function updateConsultation(int $id, $data){
        $linkpdo = BDD::getBDD()->getConnection();

        $query = $linkpdo->prepare("INSERT INTO Consultation (date_consult, heure_consult, duree_consult, id_medecin, id_usager) 
            VALUES (:date_consult, :heure_consult, :duree_consult, :id_medecin, :id_usager)");

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

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function delConsultation(int $id){
        $linkpdo = BDD::getBDD()->getConnection();
        $query = $linkpdo->prepare("DELETE FROM Consultation WHERE idConsultation = :id");

        $query->bindParam(':id', $id);
        $query->execute();

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }
    
?>