<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        <table border="1px solid white" style="border-collapse: collapse;" width="850px">
            <tr>
                <th><label for="nom">Nom</label></th>
                <th><label for="prenom">Prénom</label></th>
                <th><label for="NumLic">Numéro de licence</label></th>
                <th><label for="DateNaiss">Date de naissance</label></th>
                <th><label for="Taille">Taille</label></th>
                <th><label for="Poids">Poids</label></th>
                <th><label for="Statut">Statut</label></th>
                <th><label for="PostePref">Poste préféré</label></th>
                <th><label for="supprimer">supprimer joueur</label></th>
            </tr>
        </table>

        <input type="submit" name="action" value="Ajouter un joueur">
        <input type="submit" name="action" value="Modifier un joueur">
        <input type="submit" name="action" value="Supprimer un joueur">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $action = $_POST['action'];

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
            }
        }
    ?>
</body>
</html>
