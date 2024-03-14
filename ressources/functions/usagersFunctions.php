<?php

    require_once('../bd/bdd.php');

    function getAllUsager(){
        $linkpdo = BDD::getBDD()->getConnection();
        $query = $linkpdo->prepare("SELECT * FROM usager;");
        $query->execute();
        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function getUsager(int $id){
        $linkpdo = BDD::getBDD()->getConnection();
        $query = $linkpdo->prepare("SELECT u.* 
                                        FROM Usager u 
                                        WHERE u.id_usager = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        $matchingData = $query->fetch(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function addUsager($data) {
        $linkpdo = BDD::getBDD()->getConnection();

        $query = $linkpdo->prepare("INSERT INTO Usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) 
            VALUES (:civilite, :nom, :prenom, :sexe, :adresse, :code_postal, :ville, :date_nais, :lieu_nais, :num_secu, :id_medecin)");

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

        $idMedecin = $data['id_medecin'];
        $query->bindParam(':id_medecin', $idMedecin);

        $query->execute();

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function updateUsager(int $id, $data){
        $linkpdo = BDD::getBDD()->getConnection();
        
        try {
            $get = getUsager($id);
            
            foreach ($get as $key => $value) {
                if (!isset($data[$key])) {
                    $data[$key] = $value;
                }
            }
            $query = $linkpdo->prepare("UPDATE Usager
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
            return $success;

        } catch (PDOException $e) {
            die("Erreur de mise à jour dans la base de données: " . $e->getMessage());
        }
    }

    function delUsager(int $id){
        $linkpdo = BDD::getBDD()->getConnection();
        $query = $linkpdo->prepare("DELETE FROM Usager WHERE id_usager = :id");

        $query->bindParam(':id', $id);
        $delete = $query->execute();

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
        return $success;
    }
    
?>