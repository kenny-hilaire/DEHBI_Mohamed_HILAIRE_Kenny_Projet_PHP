<?php
  switch ($action) {
                case "Ajouter un joueur":
                    header("Location: AjouterJoueur.php");
                    exit();

                case "Modifier un joueur":
                    header("Location: Modifier_Joueur.php");
                    exit();

                case "Supprimer un joueur":
                    header("Location: SupprimerJoueur.php");
                    exit();

                case "Voir les détails du joueur":
                    header("Location: DetailsJoueur.php");
                    exit();
                case "Modifier un joueur":
                    header("Location: modifier_Joueur.php");
                    exit();
                case  "retour à l'accueil":
                    header("Location: accueil.php");
                    exit();
            }
?>
    