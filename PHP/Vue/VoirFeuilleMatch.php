<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des joueurs</title>

       <link rel="stylesheet" href="afficher_joueurs.css">
</head>
<body>
    <h1>Feuille de Match<h2>

    <table border="1" style="border-collapse: collapse;" width="900px">
        <tr>
            <th>Titulaire</th>
            <th>Poste</th>
            <th>Taille</th>
            <th>Poids licence</th>
            <th>Evaluations</th>
            <th>Commentaire</th>
        </tr>
        

        <?php
            $connectionBD = new ConnectionBD();
            $pdo = $connectionBD->getConnection();
            $daoJoueur = new JoueurDAO();
            $Joueur = $daoJoueur->obtenirActifs();
            $i = 1;?>
            <tr>
                <td><input type="select" name="titulaire">
                    <? foreach($Joueur as $j ): ?>
                    <option valeur= $1><? htmlspecialchars($j['nom']) ?></option>
                    <? $i = $i+1; ?></td>
                <td><input type= "select" name="poste"></td>
                        <? $daoParticipe = new ParticipeDAO();
                        $p = $daoParticipe->obtenirTous();
                        foreach($p as $pa): ?>
                            <option valeur = poste><? htmlspecialchars($pa['poste'])?></option></td>
                <td><?=htmlspecialchars($j['taille']) ?></td>
                <td><?htmlspecialchars($j('poids')) ?></td>


              
            



        
