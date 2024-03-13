<?php

    //Connexion
    $server = "localhost";
    $db = "cabinetmedical";
    $login = "root";
    $mdp = "";

    $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);

    function getAllUsager(){
        $query = $linkpdo->prepare("SELECT * FROM usager;");
        $query->execute();
        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function getUsager(int $id){
        $query = $linkpdo->prepare("SELECT p.*, u.* 
                                        FROM Personne p, Usager u 
                                        WHERE p.idPersonne = u.idUsager
                                        AND u.idUsager = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function addUsager(Usager $usager) {

        $query = $linkpdo->prepare("INSERT INTO Usager (id_usager, civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu) 
            VALUES (:idUsager, :civilite, :nom, :prenom, :sexe, :adresse, :codePostal, ville, :dateNaissance, :lieuNaissance, :NumSecuriteSociale)");

        $id = $usager->getIdUsager();
        $query->bindParam(':idUsager', $id);

        $civilite = $usager->getCivilite();
        $query->bindParam(':civilite', $civilite);

        $nom = $usager->getNom();
        $query->bindParam(':nom', $nom);

        $prenom = $usager->getPrenom();
        $query->bindParam(':prenom', $prenom);

        $sexe = $usager->getSexe();
        $query->bindParam(':sexe', $sexe);

        $adresse = $usager->getAdresse();
        $query->bindParam(':adresse', $adresse);

        $codePostal = $usager->getCodePostal();
        $query->bindParam(':codePostal', $codePostal);

        $ville = $usager->getVille();
        $query->bindParam(':ville', $ville);

        $dateNaissance = $usager->getDateNaissance()->format('Y-m-d');
        $query->bindParam(':dateNaissance', $dateNaissance);

        $lieuNaissance = $usager->getLieuNaissance();
        $query->bindParam(':lieuNaissance', $lieuNaissance);

        $numSecuriteSociale = $usager->getNumSecuriteSociale();
        $query->bindParam(':NumSecuriteSociale', $numSecuriteSociale);

        $query->execute();

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function updateUsager(int $id){
        $query = $linkpdo->prepare("UPDATE Usager
            SET civilite = :civilite, nom = :nom, prenom = :prenom, sexe = :sexe, adresse = :adresse, code_postal = :codePostal, ville = :ville, date_nais = :dateNaissance, lieu_nais = :lieuNaissance, num_secu = :NumSecuriteSociale
            WHERE idUsager = :id");

        $id = $usager->getIdUsager();
        $query->bindParam(':idUsager', $id);

        $civilite = $usager->getCivilite();
        $query->bindParam(':civilite', $civilite);

        $nom = $usager->getNom();
        $query->bindParam(':nom', $nom);

        $prenom = $usager->getPrenom();
        $query->bindParam(':prenom', $prenom);

        $sexe = $usager->getSexe();
        $query->bindParam(':sexe', $sexe);

        $adresse = $usager->getAdresse();
        $query->bindParam(':adresse', $adresse);

        $codePostal = $usager->getCodePostal();
        $query->bindParam(':codePostal', $codePostal);

        $ville = $usager->getVille();
        $query->bindParam(':ville', $ville);

        $dateNaissance = $usager->getDateNaissance()->format('Y-m-d');
        $query->bindParam(':dateNaissance', $dateNaissance);

        $lieuNaissance = $usager->getLieuNaissance();
        $query->bindParam(':lieuNaissance', $lieuNaissance);

        $numSecuriteSociale = $usager->getNumSecuriteSociale();
        $query->bindParam(':NumSecuriteSociale', $numSecuriteSociale);

        $query->execute();

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }

    function delUsager(int $id){
        $query = $linkpdo->prepare("DELETE FROM Usager WHERE idUsager = :id");

        $query->bindParam(':id', $id);
        $query->execute();

        $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $matchingData;
    }
    
?>