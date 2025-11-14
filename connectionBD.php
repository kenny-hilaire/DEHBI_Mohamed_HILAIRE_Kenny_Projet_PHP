<?php
$user = 'etu';
$pass = 'basketTeam';

	//1. Connnexion aux serveur SQL
	
		try {
			$linkpdo = new PDO("mysql:host=localhost;dbname=basketball;charset=utf8", $user, $pass);
		}
		//2. capture erreur eventuelles
		catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
		}
		

        $check = $linkpdo -> prepare("CREATE TABLE Joueur(
   Id_Joueur VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   numéro_licence VARCHAR(50),
   date_naissance DATE,
   taille DECIMAL(3,2),
   poids DECIMAL(3,2),
   statut VARCHAR(50),
   poste_préferer VARCHAR(50),
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

CREATE TABLE Commentaire(
   Id_Commentaire VARCHAR(50),
   notes_perso VARCHAR(50),
   date_comm DATE,
   Id_Joueur VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Commentaire),
   FOREIGN KEY(Id_Joueur) REFERENCES Joueur(Id_Joueur)
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
 ")