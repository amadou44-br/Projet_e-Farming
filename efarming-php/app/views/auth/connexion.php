<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - e-Farming</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body class="page-auth">
<div class="carte-formulaire">
    <h2>🐄 e-Farming — Connexion</h2>

    <?php if (!empty($erreur)): ?>
        <p class="message-erreur"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?route=auth/traiterConnexion">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" required>

        <button type="submit">Se connecter</button>
    </form>

    <p>Pas encore de compte ? <a href="index.php?route=auth/inscription">S'inscrire</a></p>
</div>
</body>
</html>
