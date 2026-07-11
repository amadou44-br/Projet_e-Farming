<h1>Santé & Vaccinations</h1>

<a href="index.php?route=health/ajouter" class="btn-principal">+ Ajouter un soin</a>

<?php if (empty($soins)): ?>
    <p>Aucun soin enregistré.</p>
<?php else: ?>
    <table class="tableau-donnees">
        <thead>
            <tr>
                <th>Animal</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Rappel</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($soins as $soin): ?>
                <tr>
                    <td><?= htmlspecialchars($soin['animal_identifiant']) ?></td>
                    <td><?= htmlspecialchars($soin['type']) ?></td>
                    <td><?= htmlspecialchars($soin['description'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($soin['date_evenement']) ?></td>
                    <td><?= htmlspecialchars($soin['date_rappel'] ?? '-') ?></td>
                    <td class="actions">
                        <a href="index.php?route=health/supprimer&id=<?= $soin['id'] ?>"
                           onclick="return confirm('Supprimer ce soin ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
