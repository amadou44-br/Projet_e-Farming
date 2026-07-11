<h1>Mes animaux</h1>

<a href="index.php?route=animals/ajouter" class="btn-principal">+ Ajouter un animal</a>

<?php if (empty($animaux)): ?>
    <p>Aucun animal enregistré pour le moment.</p>
<?php else: ?>
    <table class="tableau-donnees">
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Espèce</th>
                <th>Race</th>
                <th>Sexe</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animaux as $animal): ?>
                <tr>
                    <td><?= htmlspecialchars($animal['identifiant']) ?></td>
                    <td><?= htmlspecialchars($animal['espece']) ?></td>
                    <td><?= htmlspecialchars($animal['race'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($animal['sexe']) ?></td>
                    <td>
                        <span class="badge badge-<?= strtolower($animal['statut']) ?>">
                            <?= htmlspecialchars($animal['statut']) ?>
                        </span>
                    </td>
                    <td class="actions">
                        <a href="index.php?route=animals/details&id=<?= $animal['id'] ?>">Voir</a>
                        <a href="index.php?route=animals/modifier&id=<?= $animal['id'] ?>">Modifier</a>
                        <a href="index.php?route=animals/supprimer&id=<?= $animal['id'] ?>"
                           onclick="return confirm('Supprimer cet animal ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
