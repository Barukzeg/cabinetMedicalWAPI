<?php

    require_once('../bd/bdd.php');

    // Fonction pour récupérer tous les usagers
    function getAllUsager(){

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour récupérer tous les usagers
        $query = $linkpdo->prepare("SELECT * FROM usager;");
        $query->execute();
        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);

        // Retourne les données
        return $matchingData;
    }

    // Fonction pour récupérer un usager
    function getUsager(int $id){

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour récupérer un usager
        $query = $linkpdo->prepare("SELECT u.* 
                                        FROM usager u 
                                        WHERE u.id_usager = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        $matchingData = $query->fetch(PDO::FETCH_ASSOC);

        // Retourne les données
        return $matchingData;
    }

    // Fonction pour ajouter un usager
    function addUsager($data) {

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour ajouter un usager
        $query = $linkpdo->prepare("INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) 
            VALUES (:civilite, :nom, :prenom, :sexe, :adresse, :code_postal, :ville, :date_nais, :lieu_nais, :num_secu, :id_medecin)");

        // Bind des paramètres
        $civilite = $data['civilite'];
        $query->bindParam(':civilite', $civilite);

        $nom = $data['nom'];
        $query->bindParam(':nom', $nom);

        $prenom = $data['prenom'];
        $query->bindParam(':prenom', $prenom);

        $sexe = $data['sexe'];
        $query->bindParam(':sexe', $sexe);

        $adresse = $data['adresse'];
        $query->bindParam(':adresse', $adresse);

        $codePostal = $data['code_postal'];
        $query->bindParam(':code_postal', $codePostal);

        $ville = $data['ville'];
        $query->bindParam(':ville', $ville);

        $dateN = $data['date_nais'];
        $dateNaissance = date('Y-m-d', strtotime($dateN));
        $query->bindParam(':date_nais', $dateNaissance);

        $lieuNaissance = $data['lieu_nais'];
        $query->bindParam(':lieu_nais', $lieuNaissance);

        $numSecuriteSociale = $data['num_secu'];
        $query->bindParam(':num_secu', $numSecuriteSociale);

        $idMedecin = $data['id_medecin'];
        $query->bindParam(':id_medecin', $idMedecin);

        $query->execute();

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);

        // Retourne les données
        return $matchingData;
    }

    // Fonction pour mettre à jour un usager
    function updateUsager(int $id, $data){

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();
        
        try {

            // Récupération des données de l'usager à modifier
            $get = getUsager($id);
            
            // Mise à jour des données grâce aux données reçues
            foreach ($get as $key => $value) {
                if (!isset($data[$key])) {
                    $data[$key] = $value;
                }
            }

            // Requête pour mettre à jour un usager
            $query = $linkpdo->prepare("UPDATE usager
            SET civilite = :civilite, 
                nom = :nom, 
                prenom = :prenom, 
                sexe = :sexe, 
                adresse = :adresse, 
                code_postal = :code_postal, 
                ville = :ville, 
                date_nais = :date_nais, 
                lieu_nais = :lieu_nais, 
                num_secu = :num_secu,
                id_medecin = :id_medecin
            WHERE id_usager = :id_usager");

                // Bind des paramètres
                $query->bindParam(':id_usager', $id);
                
                $civilite = $data['civilite'];
                $query->bindParam(':civilite', $civilite);

                $nom = $data['nom'];
                $query->bindParam(':nom', $nom);

                $prenom = $data['prenom'];
                $query->bindParam(':prenom', $prenom);

                $sexe = $data['sexe'];
                $query->bindParam(':sexe', $sexe);

                $adresse = $data['adresse'];
                $query->bindParam(':adresse', $adresse);

                $codePostal = $data['code_postal'];
                $query->bindParam(':code_postal', $codePostal);

                $ville = $data['ville'];
                $query->bindParam(':ville', $ville);

                $dateNaissance = $data['date_nais'];
                $query->bindParam(':date_nais', $dateNaissance);

                $lieuNaissance = $data['lieu_nais'];
                $query->bindParam(':lieu_nais', $lieuNaissance);

                $numSecuriteSociale = $data['num_secu'];
                $query->bindParam(':num_secu', $numSecuriteSociale);

                $id_medecin = $data['id_medecin'];
                $query->bindParam(':id_medecin', $id_medecin);

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

    function delUsager(int $id){

        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Requête pour supprimer un usager
        $query = $linkpdo->prepare("DELETE FROM usager WHERE id_usager = :id");

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