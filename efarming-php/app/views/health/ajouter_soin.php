<h1>Ajouter un soin / vaccination</h1>

<?php if (empty($animaux)): ?>
    <p>Tu dois d'abord ajouter un animal avant d'enregistrer un soin.</p>
    <a href="index.php?route=animals/ajouter">Ajouter un animal</a>
<?php else: ?>
    <form method="POST" action="index.php?route=health/traiterAjout" class="formulaire">
        <label>Animal concerné</label>
        <select name="animal_id" required>
            <?php foreach ($animaux as $animal): ?>
                <option value="<?= $animal['id'] ?>"><?= htmlspecialchars($animal['identifiant']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Type</label>
        <select name="type" required>
            <option value="Vaccination">Vaccination</option>
            <option value="Traitement">Traitement</option>
            <option value="Maladie">Maladie</option>
        </select>

        <label>Description</label>
        <textarea name="description" rows="3"></textarea>

        <label>Date de l'événement</label>
        <input type="date" name="date_evenement" required>

        <label>Date de rappel (optionnel)</label>
        <input type="date" name="date_rappel">

        <button type="submit">Enregistrer</button>
    </form>
<?php endif; ?>

<a href="index.php?route=health/liste">← Retour à la liste</a>
