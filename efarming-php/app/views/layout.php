<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>e-Farming</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>

<header class="navbar">
    <div class="logo">🐄 e-Farming</div>
    <?php if (isset($_SESSION['user_id'])): ?>
        <nav>
            <a href="index.php?route=dashboard/index">Tableau de bord</a>
            <a href="index.php?route=animals/liste">Animaux</a>
            <a href="index.php?route=health/liste">Santé</a>
            <a href="index.php?route=sales/liste">Ventes</a>
        </nav>
        <div class="user-info">
            <span>Bonjour, <?= htmlspecialchars($_SESSION['user_nom']) ?></span>
            <a href="index.php?route=auth/deconnexion" class="btn-deconnexion">Déconnexion</a>
        </div>
    <?php endif; ?>
</header>

<main class="contenu">
    <?php require __DIR__ . '/' . $vue . '.php'; ?>
</main>

</body>
</html>
