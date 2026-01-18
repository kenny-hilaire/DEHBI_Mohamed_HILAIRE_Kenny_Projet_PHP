<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'une équipe de sport</title>
    <link rel="stylesheet" href="/PROJET_PHP/PHP/Vue/CSS/index.css">
</head>
<body>

<header>
    <nav>
        <a href="#"><img src="/PROJET_PHP/PHP/Vue/PHOTO/téléchargement-removebg-preview.png" alt="Logo" class="logo"></a>
    </nav>
</header>

<section class="Introduction">
    <h1>Bienvenue, <span class="auto-typing"></span></h1>
    <ul>
        <li>Gérez votre équipe comme un vrai pro</li>
        <li>Prenez les meilleures décisions pour mener votre équipe à la victoire</li>
        <li>Optimisez votre stratégie match après match</li>
        <li>Votre équipe, vos choix, vos victoires</li>
    </ul>
    <form action="Connexion.php">
        <button type="submit" class="btn">Connexion</button>
    </form>
</section>

<!-- Overlay image -->
<div class="overlay"></div>

<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script>
    let typed = new Typed('.auto-typing', {
        strings: ['Gérez', 'Optimisez', " dans votre application de gestion d'équipe"],
        typeSpeed: 100,
        backSpeed: 100,
        loop: true,
        fadeOut: true,
        fadeOutClass: 'typed-fade-out',
        fadeOutDelay: 500
    });
</script>

</body>
</html>
