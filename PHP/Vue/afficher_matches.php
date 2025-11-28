<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        <table border="1px solid white" border-collapse= "collapse" width="850px">
               <tr><th><label for="Date">Date</label></th>
               <th><label for="Heure">Heure</label></th>
               <th><label for="Adversaire">Adversaire</label></th>
               <th><label for="Lieu">Lieu</label></th>
               <th><label for="Résultat">Résultat</label></th>
               </tr>
        </table>

        <input type="submit" name="action" value="Voir feuille du match">
        <input type="submit" name="action" value="Préparer la feuille de match">
        <input type="submit" name="action" value="Modifier le match">
        <input type="submit" name="action" value="Supprimer le match">
        <input type="submit" name="action" value="Ajouter un match">

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $action = $_POST['action'];

                switch ($action) {
                    case "Voir feuille du match":
                        header("Location: VoirFeuilleMatch.php");
                        exit();

                    case "Préparer la feuille de match":
                        header("Location: PreparerFeuilleMatch.php");
                        exit();

                    case "Modifier le match":
                        header("Location: Modifier_Matche.php");
                        exit();

                    case "Supprimer le match":
                        header("Location: SupprimerMatch.php");
                        exit();

                    case "Ajouter un match":
                        header("Location: AjouterMatche.php");
                        exit();
                }
            }
        ?>

    </form>
</body>
</html>