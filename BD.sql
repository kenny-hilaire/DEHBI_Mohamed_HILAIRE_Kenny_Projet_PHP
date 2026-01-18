CREATE TABLE Joueur(
   Id_Joueur VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   numero_licence VARCHAR(50),
   date_naissance DATE,
   taille DECIMAL(3,2),
   poids DECIMAL(3,2),
   statut VARCHAR(50),
   poste_preferer VARCHAR(50),
   PRIMARY KEY(Id_Joueur)
);

CREATE TABLE Match_(
   Id_Match VARCHAR(50),
   DATE_ DATE,
   HEURE TIME,
   Nom_adversaire VARCHAR(50),
   résultat VARCHAR(50),
   lieu_rencontre VARCHAR(50),
   PRIMARY KEY(Id_Match)
);



CREATE TABLE Participe(
   Id_Joueur VARCHAR(50),
   Id_Match VARCHAR(50),
   id_participation VARCHAR(50),
   poste VARCHAR(50),
   evaluation_perf VARCHAR(50),
   titulaire_ou_remplacant VARCHAR(50),
   PRIMARY KEY(Id_Joueur, Id_Match),
   FOREIGN KEY(Id_Joueur) REFERENCES Joueur(Id_Joueur),
   FOREIGN KEY(Id_Match) REFERENCES Match_(Id_Match)
);

CREATE TABLE Commentaire(
   Id_Commentaire VARCHAR(50),
   notes_perso VARCHAR(50),
   date_comm   DATE, 
   Id_Joueur VARCHAR(50)
);

INSERT INTO Joueur VALUES
('J001', 'LEBRON', 'James', 'AAA001', '1984-12-04', 2.00, 99.9, 'actif', 'Ailier'),
('J002', 'CURRY', 'Stephen', 'AAA002', '1988-03-14', 1.88, 86.0, 'actif', 'Meneur'),
('J003', 'DURANT', 'Kevin', 'AAA003', '1988-09-29', 2.08, 108.0, 'actif', 'Ailier'),
('J004', 'DAVIS', 'Anthony', 'AAA004', '1993-03-11', 2.08, 114.0, 'actif', 'Pivot'),
('J005', 'IRVING', 'Kyrie', 'AAA005', '1992-03-23', 1.88, 88.0, 'actif', 'Meneur'),
('J006', 'HARDEN', 'James', 'AAA006', '1989-08-26', 1.96, 100.0, 'actif', 'Arrière'),
('J007', 'ANTETOKOUNMPO', 'Giannis', 'AAA007', '1994-12-06', 2.11, 110.0, 'actif', 'Ailier fort'),
('J008', 'JOKIC', 'Nikola', 'AAA008', '1995-02-19', 2.11, 129.0, 'actif', 'Pivot');

INSERT INTO matchs VALUES
('M001', '2025-01-10', '18:00:00', 'Lakers', 'Victoire', 'Domicile'),
('M002', '2025-01-17', '20:30:00', 'Warriors', 'Défaite', 'Extérieur'),
('M003', '2025-01-24', '19:00:00', 'Bulls', 'Egalité', 'Domicile');

INSERT INTO Participe VALUES
-- Match 1
('J001', 'M001', 'P001', 'Ailier', '5', 'Titulaire'),
('J002', 'M001', 'P002', 'Meneur', '4', 'Titulaire'),
('J003', 'M001', 'P003', 'Ailier', '5', 'Titulaire'),
('J004', 'M001', 'P004', 'Pivot', '4', 'Titulaire'),
('J005', 'M001', 'P005', 'Meneur', '3', 'Remplaçant'),
('J006', 'M001', 'P016', 'Arrière', '4', 'Titulaire'),
-- Match 2
('J001', 'M002', 'P006', 'Ailier', '4', 'Titulaire'),
('J006', 'M002', 'P007', 'Arrière', '3', 'Titulaire'),
('J007', 'M002', 'P008', 'Ailier fort', '5', 'Titulaire'),
('J008', 'M002', 'P009', 'Pivot', '4', 'Titulaire'),
('J002', 'M002', 'P010', 'Meneur', '2', 'Remplaçant'),
('J003', 'M002', 'P017', 'Ailier', '4', 'Titulaire'),

-- Match 3
('J003', 'M003', 'P011', 'Ailier', '4', 'Titulaire'),
('J004', 'M003', 'P012', 'Pivot', '4', 'Titulaire'),
('J005', 'M003', 'P013', 'Meneur', '3', 'Titulaire'),
('J006', 'M003', 'P014', 'Arrière', '4', 'Titulaire'),
('J007', 'M003', 'P018', 'Ailier fort', '5', 'Titulaire'),
('J008', 'M003', 'P015', 'Pivot', '5', 'Remplaçant');

