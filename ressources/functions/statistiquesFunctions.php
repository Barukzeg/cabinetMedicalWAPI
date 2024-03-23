<?php

    require_once('../bd/bdd.php');

    // Fonction pour récupérer tous les usagers
    function getStats(int $id){

        $data = array();
        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();

        // Si l'id est 1, on récupère les statistiques concernant les usagers
        if ($id == 1) {

            // Requête pour récupérer le nombre d'usagers de moins de 25 ans, distingués par civilité
            $query = $linkpdo->prepare("SELECT sexe, COUNT(*) as nb_usagers
                                        FROM Usager
                                        WHERE date_nais > DATE_SUB(CURDATE(), INTERVAL 25 YEAR)
                                        GROUP BY sexe;");
            $query->execute();
            $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
            $data['usagers_moins_25'] = $matchingData;

            // Requête pour récupérer le nombre d'usagers entre 25 et 50 ans, distingués par civilité
            $query = $linkpdo->prepare("SELECT sexe, COUNT(*) as nb_usagers
                                        FROM Usager
                                        WHERE date_nais BETWEEN DATE_SUB(CURDATE(), INTERVAL 50 YEAR) AND DATE_SUB(CURDATE(), INTERVAL 25 YEAR)
                                        GROUP BY sexe;");
            $query->execute();
            $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
            $data['usagers_25_50'] = $matchingData;

            // Requête pour récupérer le nombre d'usagers de plus de 50 ans, distingués par civilité
            $query = $linkpdo->prepare("SELECT sexe, COUNT(*) as nb_usagers
                                        FROM Usager
                                        WHERE date_nais < DATE_SUB(CURDATE(), INTERVAL 50 YEAR)
                                        GROUP BY sexe;");
            $query->execute();
            $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
            $data['usagers_plus_50'] = $matchingData;

        // Si l'id est 2, on récupère les statistiques concernant les médecins
        } else if ($id == 2) {

            // Requête pour récupérer pour chaque medecin son nom prénom et la somme du nombre d'heures de consultations qu'il a déjà effectué
            $query = $linkpdo->prepare("SELECT m.nom, m.prenom, SUM(c.duree_consult) as duree_consult
                                        FROM Medecin m
                                        JOIN Consultation c ON m.id_medecin = c.id_medecin
                                        GROUP BY m.id_medecin;");

            $query->execute();
            $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
            $data['medecins_nb_heures'] = $matchingData;
        }

        // Retourne les données
        return $data;
    }
?>