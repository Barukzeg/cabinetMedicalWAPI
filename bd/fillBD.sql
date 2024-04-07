drop table consultation;
drop table usager;
drop table medecin;

CREATE TABLE medecin(
   id_medecin INT AUTO_INCREMENT,
   civilite VARCHAR(5) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   CONSTRAINT PK_medecin PRIMARY KEY(id_medecin)
);

CREATE TABLE usager(
   id_usager INT AUTO_INCREMENT,
   civilite VARCHAR(50) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   sexe CHAR(1) NOT NULL,
   adresse VARCHAR(50) NOT NULL,
   code_postal CHAR(5) NOT NULL,
   ville VARCHAR(50) NOT NULL,
   date_nais DATE NOT NULL,
   lieu_nais VARCHAR(50) NOT NULL,
   num_secu CHAR(15) NOT NULL,
   id_medecin INT,
   CONSTRAINT PK_usager PRIMARY KEY(id_usager),
   CONSTRAINT AK_usager UNIQUE(num_secu),
   CONSTRAINT FK_usager_medecin FOREIGN KEY(id_medecin) REFERENCES medecin(id_medecin)
);

CREATE TABLE consultation(
   id_consult INT AUTO_INCREMENT,
   date_consult DATE NOT NULL,
   heure_consult TIME NOT NULL,
   duree_consult TINYINT NOT NULL,
   id_medecin INT NOT NULL,
   id_usager INT NOT NULL,
   CONSTRAINT PK_consultation PRIMARY KEY(id_consult),
   CONSTRAINT AK_consultation_idx2 UNIQUE(id_medecin, date_consult, heure_consult),
   CONSTRAINT AK_consultation_idx1 UNIQUE(id_usager, date_consult, heure_consult),
   CONSTRAINT FK_consultation_medecin FOREIGN KEY(id_medecin) REFERENCES medecin(id_medecin),
   CONSTRAINT FK_consultation_usager FOREIGN KEY(id_usager) REFERENCES usager(id_usager)
);

INSERT INTO medecin(civilite, nom, prenom) VALUES('M.', 'Duval', 'Jules');
INSERT INTO medecin(civilite, nom, prenom) VALUES('M.', 'Denis', 'Nicolas');
INSERT INTO medecin(civilite, nom, prenom) VALUES('M.', 'Dumont', 'Raphaël');
INSERT INTO medecin(civilite, nom, prenom) VALUES('M', 'Marie', 'Yanis');
INSERT INTO medecin(civilite, nom, prenom) VALUES('M.', 'Lemaire', 'Valentin');
INSERT INTO medecin(civilite, nom, prenom) VALUES('Mme.', 'Noel', 'Pauline');
INSERT INTO medecin(civilite, nom, prenom) VALUES('Mme.', 'Meyer', 'Romane');
INSERT INTO medecin(civilite, nom, prenom) VALUES('Mme.', 'Dufour', 'Juliette');
INSERT INTO medecin(civilite, nom, prenom) VALUES('Mme.', 'Menier', 'Zoé');
INSERT INTO medecin(civilite, nom, prenom) VALUES('Mme.', 'Brun', 'Lilou');

INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Martin', 'Lucas', 'M', '1 Rue du Capitole', '31000', 'Toulouse', '1967-05-22', 'Toulouse', '131670519283746', 1);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Bernard', 'Enzo', 'M', '2 Avenue des Minimes', '31400', 'Toulouse', '1978-09-14', 'Toulouse', '131780919283746', 2);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Thomas', 'Thomas', 'M', '3 Rue de la Dalbade', '31500', 'Toulouse', '1985-12-03', 'Toulouse', '131851219283746', 3);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Petit', 'Théo', 'M', '4 Boulevard Lascrosses', '31100', 'Toulouse', '2003-07-18', 'Toulouse', '131030719283746', 4);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Robert', 'Hugo', 'M', '5 Rue Saint-Rome', '31900', 'Toulouse', '1990-11-26', 'Toulouse', '131901119283746', 5);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Richard', 'Nathan', 'M', '6 Allée Jean Jaurès', '31700', 'Toulouse', '1972-02-09', 'Toulouse', '131720219283746', 6);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Durand', 'Maxime', 'M', '7 Rue du Faubourg Bonnefoy', '31400', 'Toulouse', '1965-08-31', 'Toulouse', '131650819283746', 7);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M', 'Dubois', 'Mathis', 'M', '8 Rue des Filatiers', '31300', 'Toulouse', '2008-04-11', 'Toulouse', '131080419283746', 8);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Moreau', 'Louis', 'M', '9 Boulevard de Strasbourg', '31100', 'Toulouse', '1989-06-25', 'Toulouse', '131890619283746', 9);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Laurent', 'Clément', 'M', '10 Rue de Metz', '31400', 'Toulouse', '1975-10-14', 'Toulouse', '131751019283746', 10);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Simon', 'Alexendre', 'M', '11 Allée François Verdier', '31300', 'Toulouse', '1955-03-17', 'Toulouse', '131550319283746', 1);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Michel', 'Antoine', 'M', '12 Rue de la République', '31300', 'Toulouse', '1997-01-05', 'Toulouse', '131970119283746', 2);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Lefebre', 'Tom', 'M', '13 Avenue de Grande-Bretagne', '31200', 'Toulouse', '1982-09-28', 'Toulouse', '131820919283746', 1);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Leroy', 'Léo', 'M', '14 Rue de la Concorde', '31500', 'Toulouse', '1968-12-20', 'Toulouse', '131681219283746', 2);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Roux', 'Alexis', 'M', '15 Boulevard de Thibaud', '31700', 'Toulouse', '2000-06-08', 'Toulouse', '131001219283746', 3);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'David', 'Quentin', 'M', '16 Rue de la Pomme', '31600', 'Toulouse', '1973-02-03', 'Toulouse', '131730219283746', 4);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Bertrand', 'Arthur', 'M', '17 Rue de la Colombette', '31800', 'Toulouse', '1960-07-19', 'Toulouse', '131600719283746', 5);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Maurel', 'Paul', 'M', '18 Allée Charles de Fitte', '31000', 'Toulouse', '1958-11-30', 'Toulouse', '131581119283746', 6);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Fournier', 'Baptiste', 'M', '19 Rue des Lois', '31000', 'Toulouse', '1987-04-23', 'Toulouse', '131870419283746', 7);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('M.', 'Girard', 'Romain', 'M', '20 Avenue Camille Pujol', '31100', 'Toulouse', '1995-08-07', 'Toulouse', '131950819283746', 8);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Bonnet', 'Léa', 'F', '21 Rue des Marchands', '31300', 'Toulouse', '1962-01-15', 'Toulouse', '231620119283746', 9);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Dupont', 'Emma', 'F', '22 Boulevard Riquet', '31000', 'Toulouse', '2010-09-02', 'Toulouse', '231100919283746', 10);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Lambert', 'Manon', 'F', '23 Rue de la Chaîne', '31800', 'Toulouse', '1954-05-26', 'Toulouse', '231540519283746', 1);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Fontaine', 'Chloé', 'F', '24 Allée de Brienne', '31700', 'Toulouse', '1992-12-10', 'Toulouse', '231921219283746', 2);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Rousseau', 'Camille', 'F', '25 Rue du Taur', '31000', 'Toulouse', '1979-06-13', 'Toulouse', '231790619283746', 1);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Vincent', 'Clara', 'F', '26 Rue de la Concorde', '31500', 'Toulouse', '1984-03-07', 'Toulouse', '231840319283746', 2);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Muller', 'Sarah', 'F', '27 Boulevard de Thibaud', '31700', 'Toulouse', '2005-10-24', 'Toulouse', '231051019283746', 3);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Lefevre', 'Noëmie', 'F', '28 Rue de la Pomme', '31600', 'Toulouse', '1969-04-16', 'Toulouse', '231690419283746', 4);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Faure', 'Jade', 'F', '29 Rue de la Colombette', '31800', 'Toulouse', '1970-09-29', 'Toulouse', '231700919283746', 5);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Andre', 'Océane', 'F', '30 Allée Charles de Fitte', '31000', 'Toulouse', '1952-08-11', 'Toulouse', '231520819283746', 6);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Mercier', 'Marie', 'F', '31 Rue des Lois', '31000', 'Toulouse', '2009-01-28', 'Toulouse', '231090119283746', 7);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Blanc', 'Lucie', 'F', '32 Avenue Camille Pujol', '31100', 'Toulouse', '1998-05-21', 'Toulouse', '231080519283746', 8);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Guerin', 'Anaïs', 'F', '33 Rue du Printemps', '31300', 'Toulouse', '1966-11-02', 'Toulouse', '231661119283746', 9);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Boyer', 'Lola', 'F', '34 Rue du Colonel Pélissier', '31400', 'Toulouse', '1977-04-06', 'Toulouse', '231770419283746', 10);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Chevalier', 'Eva', 'F', '35 Avenue de Lyon', '31500', 'Toulouse', '1956-02-18', 'Toulouse', '231560219283746', 1);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Francois', 'Mathilde', 'F', '36 Rue de la Providence', '31300', 'Toulouse', '1991-07-30', 'Toulouse', '231910719283746', 2);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Legrand', 'Julie', 'F', '37 Rue du Printemps', '31300', 'Toulouse', '2001-12-15', 'Toulouse', '231011219283746', 1);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Gauthier', 'Laura', 'F', '38 Rue du Colonel Pélissier', '31400', 'Toulouse', '1964-06-27', 'Toulouse', '231640619283746', 2);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Garcia', 'Lisa', 'F', '39 Avenue de Lyon', '31500', 'Toulouse', '1971-10-09', 'Toulouse', '231710919283746', 3);
INSERT INTO usager(civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES('Mme.', 'Perrin', 'Louise', 'F', '40 Rue de la Bourse', '31200', 'Toulouse', '1986-08-04', 'Toulouse', '231860819283746', 4);

INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-04-15', '09:00:00', 30, 1, 1);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-03-02', '10:30:00', 45, 2, 2);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-05-23', '11:45:00', 60, 3, 3);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-01-19', '12:00:00', 75, 4, 4);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-06-07', '13:15:00', 90, 5, 5);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-02-29', '14:30:00', 105, 6, 6);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-05-10', '15:45:00', 120, 7, 7);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-03-18', '08:00:00', 30, 8, 8);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-01-31', '08:15:00', 45, 9, 9);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-05-06', '08:30:00', 60, 10, 10);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-06-27', '08:45:00', 75, 1, 11);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2023-12-08', '09:00:00', 90, 2, 12);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-04-07', '09:15:00', 105, 3, 13);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-01-16', '09:30:00', 120, 4, 14);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-06-21', '09:45:00', 30, 5, 15);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-03-12', '10:00:00', 45, 6, 16);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-05-02', '10:15:00', 60, 7, 17);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-02-09', '10:30:00', 75, 8, 18);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-06-16', '10:45:00', 90, 9, 19);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-03-25', '11:00:00', 105, 10, 20);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-01-07', '11:15:00', 120, 1, 21);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-05-17', '11:30:00', 30, 2, 22);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2023-11-11', '11:45:00', 45, 3, 23);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-02-22', '12:00:00', 60, 4, 24);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-06-01', '12:15:00', 75, 5, 25);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-03-08', '12:30:00', 90, 6, 26);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-05-29', '12:45:00', 105, 7, 27);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-01-24', '13:00:00', 120, 8, 28);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-04-21', '13:15:00', 30, 9, 29);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-02-15', '13:30:00', 45, 10, 30);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-06-26', '13:45:00', 60, 1, 31);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-03-16', '14:00:00', 75, 2, 32);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-05-07', '14:15:00', 90, 3, 33);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-01-04', '14:30:00', 105, 4, 34);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-06-20', '14:45:00', 120, 5, 35);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-02-05', '08:00:00', 30, 6, 36);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-04-26', '08:15:00', 45, 7, 37);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-01-13', '08:30:00', 60, 8, 38);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-05-12', '08:45:00', 75, 9, 39);
INSERT INTO consultation(date_consult, heure_consult, duree_consult, id_medecin, id_usager) VALUES('2024-03-01', '09:00:00', 90, 10, 40);