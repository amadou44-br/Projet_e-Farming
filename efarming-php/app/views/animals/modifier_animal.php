<h1>Modifier l'animal <?= htmlspecialchars($animal['identifiant']) ?></h1>

<form method="POST" action="index.php?route=animals/traiterModification" class="formulaire">
    <input type="hidden" name="id" value="<?= $animal['id'] ?>">

    <label>Identifiant (tag/boucle)</label>
    <input type="text" name="identifiant" value="<?= htmlspecialchars($animal['identifiant']) ?>" required>

    <label>Espèce</label>
    <select name="espece" required>
        <?php foreach (['Bovin', 'Ovin', 'Caprin', 'Volaille', 'Autre'] as $espece): ?>
            <option value="<?= $espece ?>" <?= $animal['espece'] === $espece ? 'selected' : '' ?>>
                <?= $espece ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Race</label>
    <input type="text" name="race" value="<?= htmlspecialchars($animal['race'] ?? '') ?>">

    <label>Sexe</label>
    <select name="sexe" required>
        <option value="Male" <?= $animal['sexe'] === 'Male' ? 'selected' : '' ?>>Mâle</option>
        <option value="Femelle" <?= $animal['sexe'] === 'Femelle' ? 'selected' : '' ?>>Femelle</option>
    </select>

    <label>Date de naissance</label>
    <input type="date" name="date_naissance" value="<?= htmlspecialchars($animal['date_naissance'] ?? '') ?>">

    <label>Statut</label>
    <select name="statut" required>
        <?php foreach (['Actif', 'Vendu', 'Décédé'] as $statut): ?>
            <option value="<?= $statut ?>" <?= $animal['statut'] === $statut ? 'selected' : '' ?>>
                <?= $statut ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Enregistrer les modifications</button>
</form>

<a href="index.php?route=animals/details&id=<?= $animal['id'] ?>">← Retour aux détails</a>
