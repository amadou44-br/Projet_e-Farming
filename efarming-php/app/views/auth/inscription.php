<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - e-Farming</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body class="page-auth">
<div class="carte-formulaire">
    <h2>🐄 e-Farming — Inscription</h2>

    <?php if (!empty($erreur)): ?>
        <p class="message-erreur"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?route=auth/traiterInscription">
        <label>Nom complet</label>
        <input type="text" name="nom" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" required>

        <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà un compte ? <a href="index.php?route=auth/connexion">Se connecter</a></p>
</div>
</body>
</html>
