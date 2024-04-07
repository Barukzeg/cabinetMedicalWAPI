<?php

    require_once('../bd/bdd.php');

    // Fonction pour récupérer tous les usagers
    function getStats(int $id){

        $data = array();
        // Connexion à la base de données
        $linkpdo = BDD::getBDD()->getConnection();
        echo $id;
        // Si l'id est 1, on récupère les statistiques concernant les usagers
        if ($id == 1) {

            $query = $linkpdo->prepare("
                SELECT sexe,
                       SUM(IF(date_nais > DATE_SUB(CURDATE(), INTERVAL 25 YEAR), 1, 0)) AS usagers_moins_25,
                       SUM(IF(date_nais BETWEEN DATE_SUB(CURDATE(), INTERVAL 50 YEAR) AND DATE_SUB(CURDATE(), INTERVAL 25 YEAR), 1, 0)) AS usagers_25_50,
                       SUM(IF(date_nais < DATE_SUB(CURDATE(), INTERVAL 50 YEAR), 1, 0)) AS usagers_plus_50
                FROM usager
                GROUP BY sexe;
            ");
            
            $query->execute();
            $rawData = $query->fetchAll(PDO::FETCH_ASSOC);

            $data = [
                'usagers_moins_25' => [],
                'usagers_25_50' => [],
                'usagers_plus_50' => [],
            ];

            foreach ($rawData as $row) {
                $data['usagers_moins_25'][$row['sexe']] = $row['usagers_moins_25'];
                $data['usagers_25_50'][$row['sexe']] = $row['usagers_25_50'];
                $data['usagers_plus_50'][$row['sexe']] = $row['usagers_plus_50'];
            }

        // Si l'id est 2, on récupère les statistiques concernant les médecins
        } else if ($id == 2) {

            // Requête pour récupérer pour chaque medecin son nom prénom et la somme du nombre d'heures de consultations qu'il a déjà effectué
            $query = $linkpdo->prepare("SELECT m.nom, m.prenom, SUM(c.duree_consult) as duree_consult
                                        FROM medecin m
                                        JOIN consultation c ON m.id_medecin = c.id_medecin
                                        GROUP BY m.id_medecin;");

            $query->execute();
            $matchingData = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        // Retourne les données
        return $matchingData;
    }
?>