# DEHBI_Mohamed_HILAIRE_Kenny_Projet_PHP _ Projet PHP sur la gestion d'une équipe de basket

Projet PHP : Gestion d'une équipe de Basket
Ce projet permet de gérer les joueurs, les matchs et les statistiques d'une équipe de basketball. Il a été réalisé dans le cadre du BUT Informatique à l'Université Paul Sabatier.

<h1> Lien vers le dépot git: https://github.com/kenny-hilaire/DEHBI_Mohamed_HILAIRE_Kenny_Projet_PHP </h1>
<h1> Lien vers notre alwaysData : https://admin.alwaysdata.com/site/

Accès Base de Données (phpMyAdmin Alwaysdata)
Hôte : mysql-hilaire.alwaysdata.net
User : hilaire
mdp: PhpProject2025*
Base de données : hilaire_projetphp

Accès au site
Identifiant du site : HLKDH
MDP : PhpProject2025

Arborescence du projet

DEHBI_Mohamed_HILAIRE_Kenny_Projet_PHP/
│
├── www/                              # Racine du serveur Alwaysdata
│   │
│   ├── modele/                       # [M] Logique de données et classes DAO
│   │   ├── connexionBD.php           # Singleton de connexion PDO
│   │   ├── Joueur.php                # Classe métier Joueur
│   │   ├── Match.php                 # Classe métier Match
│   │   ├── Commentaire.php           # Classe métier Commentaire
│   │   ├── Participe.php             # Classe métier pour l'association Match/Joueur
│   │   ├── DaoJoueur.php             # Accès BD pour les joueurs
│   │   ├── DaoMatch.php              # Accès BD pour les matchs
│   │   ├── DaoCommentaire.php        # Accès BD pour les commentaires
│   │   ├── DaoParticipe.php          # Accès BD pour la participation
│   │   └── Fonction_utilses.php      # Calculs stats et outils
│   │
│   ├── Vue/                          # [V] Interfaces et affichage HTML
│   │   ├── CSS/                      # Toutes les feuilles de style
│   │   │   ├── afficher_joueurs.css
│   │   │   ├── menuPrincipale.css
│   │   │   ├── nav.css
│   │   │   └── ... (un CSS par page)
│   │   ├── PHOTO/                    # Images et photos de l'équipe
│   │   ├── nav.php                   # Menu de navigation commun
│   │   ├── footer.php                # Pied de page
│   │   ├── menuPrincipale.php        # Accueil Coach
│   │   ├── afficher_joueurs.php      # Liste des joueurs
│   │   ├── afficher_matches.php      # Calendrier des matchs
│   │   ├── AjouterJoueur.php         # Formulaire ajout joueur
│   │   ├── AjouterMatche.php         # Formulaire ajout match
│   │   ├── modifier_Joueur.php       # Édition d'un joueur
│   │   ├── modifier_match.php        # Édition d'un match
│   │   ├── VoirFeuilleMatch.php      # Visualisation des détails
│   │   ├── statistique.php           # Page des stats d'équipe
│   │   └── Connexion.php             # Page de login
│   │
│   ├── Controleur/                   # [C] Traitement des actions et formulaires
│   │   ├── ajouterMatch.php          # Traitement ajout match
│   │   ├── controleurAfficherJ.php   # Gestion affichage joueurs
│   │   ├── GestionAjouterFeuilleDeMatch.php # Logique feuille match
│   │   └── supprimer_joueur.css      # (Fichier mal placé ? Devrait être dans CSS)
│   │
│   └── admin/                        # Fichiers d'administration serveur
│
├── README.md                         # Documentation obligatoire
└── .git/                             # Historique des versions




Analyse : Déchiffrement du sujet et définition des besoins.

Conception : Création du MCD (Modèle Conceptuel de Données) et du dictionnaire de données.

Mise en place : Initialisation du dépôt GitHub et structuration des répertoires (MVC).

Développement :

Création de la base de données sur MariaDB.

Développement des classes modèles et DAO.

Réalisation des interfaces de visualisation (Affichage joueurs/matchs).

Implémentation des fonctionnalités CRUD (Ajouter, Modifier, Supprimer).

Déploiement : Configuration et mise en ligne sur le serveur Alwaysdata.