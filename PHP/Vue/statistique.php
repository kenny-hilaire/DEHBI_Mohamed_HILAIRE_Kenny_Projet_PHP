<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'une équipe de sport</title>
    <link rel="stylesheet" href="CSS/statistique.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <section id="title">
        <h1>Bilan de la Saison</h1><br>

        <?php
        session_start();

        // Si la variable 'auth' n'existe pas ou n'est pas vraie, on dégage l'intrus
        if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
            header("Location: Connexion.php");
            exit();
        }
        require_once '../modele/DaoJoueur.php'; 
        require_once '../modele/connexionBD.php';
        require_once '../modele/Fonction_utilses.php';
 
        $connectionBD = new ConnectionBD();
        $pdo = $connectionBD->getConnection();
        $fonction = new Fonction_utiles(); 
        $joueurDAO = new JoueurDAO(); 
        $listeJoueurs = $joueurDAO->obtenirTous();
    ?>
        <section id="Global_Stats">
            <div class="percent">
                <h3>Matchs Gagnés : <?= $fonction->nombre_victoire(); ?>%</h3>
            </div>
            
            <div class="percent">
                <h3>Matchs Perdus : <?= $fonction->nombre_perdu(); ?>%</h3>
            </div>
            
            <div class="percent">
                <h3>Matchs Nuls : <?= $fonction->nombre_draw(); ?>%</h3>
            </div>
        </section>
    </section>

    <section id="board">
        <h1>Tableau des performance</h1>

        <table>
            <tr>
                <th>Joueur</th>
                <th>Statut</th>
                <th>Poste Préferer</th>
                <th>Titularisation</th>
                <th>Remplacemnt</th>
                <th>Moyenne.Eval</th>
                <th>% Victoires</th>
                <th>Sélections Conséc.</th>
            </tr>

            <?php 
        // Exemple de boucle (il faudra exécuter ta requête $sql avant)
        foreach ($listeJoueurs as $j): 
            $id = $j['Id_Joueur'];
        ?>
        <tr>
            <td><?= htmlspecialchars($j['nom']) ?></td>
            <td><?= htmlspecialchars($j['statut']) ?></td>
            <td><?= htmlspecialchars($j['poste_preferer']) ?></td>
            <td><?= $fonction->nombreMatch_Titulaire($id); ?></td>
            <td><?= $fonction->nombreMatchRemplaçant($id); ?></td>
            <td><?= $fonction->moyenneEvaluation($id); ?> / 5</td>
            <td><?= $fonction->pourcentage_victoire_joueur($id); ?></td>
        </tr>
        <?php endforeach; ?>
        </table>
        
    </section>
        <?php include 'footer.php'; ?>
    </body>
</html>