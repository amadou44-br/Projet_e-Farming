<h1>Enregistrer une vente</h1>

<?php if (empty($animaux)): ?>
    <p>Aucun animal disponible à la vente (déjà vendus ou aucun animal enregistré).</p>
    <a href="index.php?route=animals/ajouter">Ajouter un animal</a>
<?php else: ?>
    <form method="POST" action="index.php?route=sales/traiterAjout" class="formulaire">
        <label>Animal vendu</label>
        <select name="animal_id" required>
            <?php foreach ($animaux as $animal): ?>
                <option value="<?= $animal['id'] ?>"><?= htmlspecialchars($animal['identifiant']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Acheteur</label>
        <input type="text" name="acheteur" required>

        <label>Prix</label>
        <input type="number" step="0.01" name="prix" required>

        <label>Date de vente</label>
        <input type="date" name="date_vente" required>

        <button type="submit">Enregistrer la vente</button>
    </form>
<?php endif; ?>

<a href="index.php?route=sales/liste">← Retour à la liste</a>
