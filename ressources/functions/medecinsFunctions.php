<?php

    require_once('../bd/bdd.php');

    // Fonction pour récupérer tous les medecins
    function getAllMedecin(){

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour récupérer tous les medecins
        $query = $linkpdo->prepare("SELECT * FROM medecin;");
        $query->execute();
        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);

        // Retourne les données
        return $matchingData;
    }

    // Fonction pour récupérer un medecin
    function getMedecin(int $id){

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour récupérer un medecin
        $query = $linkpdo->prepare("SELECT u.* 
                                        FROM Medecin u 
                                        WHERE u.id_medecin = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        $matchingData = $query->fetch(PDO::FETCH_ASSOC);

        // Retourne les données
        return $matchingData;
    }

    // Fonction pour ajouter un medecin
    function addMedecin($data) {

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour ajouter un medecin
        $query = $linkpdo->prepare("INSERT INTO medecin (civilite, nom, prenom) 
                                                VALUES (:civilite, :nom, :prenom)");

        // Bind des paramètres
        $civilite = $data['civilite'];
        $query->bindParam(':civilite', $civilite);

        $nom = $data['nom'];
        $query->bindParam(':nom', $nom);

        $prenom = $data['prenom'];
        $query->bindParam(':prenom', $prenom);

        $query->execute();

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);

        // Retourne les données
        return $matchingData;
    }

    // Fonction pour mettre à jour un medecin
    function updateMedecin(int $id, $data){

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();
        
        try {

            // Récupération des données de l'medecin à modifier
            $get = getmedecin($id);
            
            // Mise à jour des données grâce aux données reçues
            foreach ($get as $key => $value) {
                if (!isset($data[$key])) {
                    $data[$key] = $value;
                }
            }

            // Requête pour mettre à jour un medecin
            $query = $linkpdo->prepare("UPDATE Medecin
                                        SET civilite = :civilite, 
                                            nom = :nom, 
                                            prenom = :prenom
                                        WHERE id_medecin = :id");

                // Bind des paramètres
                $query->bindParam(':id_medecin', $id);
                
                $civilite = $data['civilite'];
                $query->bindParam(':civilite', $civilite);

                $nom = $data['nom'];
                $query->bindParam(':nom', $nom);

                $prenom = $data['prenom'];
                $query->bindParam(':prenom', $prenom);

                $update = $query->execute();

                // Vérification de la mise à jour
                if ($update) {
                    $rowCount = $query->rowCount();
                    if ($rowCount > 0) {
                        $success = true;
                    } else {
                        $success = false;
                    }
                } else {
                    $success = false;
                }
            
            // Retourne le résultat
            return $success;

        } catch (PDOException $e) {
            die("Erreur de mise à jour dans la base de données: " . $e->getMessage());
        }
    }

    function delMedecin(int $id){

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour supprimer un medecin
        $query = $linkpdo->prepare("DELETE FROM Medecin WHERE id_medecin = :id");

        $query->bindParam(':id', $id);
        $delete = $query->execute();

        // Vérification de la suppression
        if ($delete) {
            $rowCount = $query->rowCount();
            if ($rowCount > 0) {
                $success = true;
            } else {
                $success = false;
            }
        } else {
            $success = false;
        }

        // Retourne le résultat
        return $success;
    }
    
?>