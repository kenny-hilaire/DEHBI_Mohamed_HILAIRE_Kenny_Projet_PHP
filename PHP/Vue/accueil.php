<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'une équipe de sport</title>
    <link rel="stylesheet" href="CSS/index.css">
</head>
<body>

    <header>
        <nav>
            <a href="#"><img src="PHOTO/téléchargement-removebg-preview.png" alt="" class="logo"></a>
        </nav>
    </header>


    <section class="Introduction">
        <h1>Ici <span class="auto-typing"></span></h2>
        <ul>
            <li>Gérer votre équipe comme un vrai pro </li><br>
            <li>Prenez les meilleurs décision pour mener votre equipe à la victoire</li><br>
            <li>Optimisez votre stratégie match après match</li><br>
            <li>Votre equipe, vos choix, vos victoire</li><br>
        </ul>
        <form action="Connexion.php">
            <button type="submit">Connexion</button>
        </form>

    </section>
    <!-- L'image de fond sera gérée par la div .overlay -->
    <div class="overlay"></div>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script>
        let typed= new Typed('.auto-typing', {
            strings: ['Gérez', "Optimisez", "Bienvenue dans votre application de gestion d'equipe"],
            typeSpeed: 100,
            backSpeed: 100,
            loop: true,
            fadeOut: true,
            fadeOutClass: 'typed-fade-out',
            fadeOutDelay: 500
        })
    </script>
</body>
</html>
