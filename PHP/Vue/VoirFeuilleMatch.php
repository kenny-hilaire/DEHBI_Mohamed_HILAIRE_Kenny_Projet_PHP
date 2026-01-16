<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des joueurs</title>

       <link rel="stylesheet" href="afficher_joueurs.css">
</head>
<body>
        <?php
        require_once '../modele/connexionBD.php';
        require_once '../modele/DaoMatch.php'; 
        require_once '../modele/DaoJoueur.php';
            $connectionBD = new ConnectionBD();
            $pdo = $connectionBD->getConnection();
            $daoJoueur = new JoueurDAO();
            $Joueur = $daoJoueur->obtenirActifs();
        ?>
            <form action="index.php?action=enregistrerFeuille" method="POST">
    <h2>Titulaires</h2>
    <table class="feuille-table">
        <thead>
            <tr class="ligne-joueur">
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Poste</th>
                <th scope="col">Taille</th>
                <th scope="col">Poids</th>
                <th scope="col">commentaire</th>
                <th scope ="col">evaluations</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                <select name="nomTitu" class="select-joueur">
                    <option value="">-- Nom --</option>
                    <?php foreach ($joueurs as $j): ?>
                        <option value="<?= $j['nom'] ?>"><?= htmlspecialchars($j['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
                    </td>
            </tr>
        </tbody>
        
    </table>

    <h2>Remplaçants (minimum 5)</h2>
    <table class="feuille-table">
        <thead>
            <tr class="ligne-joueur">
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Poste</th>
                <th scope="col">Taille</th>
                <th scope="col">Poids</th>
                <th scope="col">commentaire</th>
                <th scope ="col">evaluations</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                <select name="nomTitu" class="select-joueur">
                    <option value="">-- Nom --</option>
                    <?php foreach ($joueurs as $j): ?>
                        <option value="<?= $j['nom'] ?>"><?= htmlspecialchars($j['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
                    </td>
            </tr>
        </tbody>
        
    </table>
    
    <button type="submit" id="btn-valider">Valider la feuille</button>
</form>

              
            



        
