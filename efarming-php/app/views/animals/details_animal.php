<h1>Fiche de l'animal : <?= htmlspecialchars($animal['identifiant']) ?></h1>

<div class="carte-details">
    <p><strong>Espèce :</strong> <?= htmlspecialchars($animal['espece']) ?></p>
    <p><strong>Race :</strong> <?= htmlspecialchars($animal['race'] ?? '-') ?></p>
    <p><strong>Sexe :</strong> <?= htmlspecialchars($animal['sexe']) ?></p>
    <p><strong>Date de naissance :</strong> <?= htmlspecialchars($animal['date_naissance'] ?? '-') ?></p>
    <p><strong>Statut :</strong>
        <span class="badge badge-<?= strtolower($animal['statut']) ?>">
            <?= htmlspecialchars($animal['statut']) ?>
        </span>
    </p>

    <a href="index.php?route=animals/modifier&id=<?= $animal['id'] ?>" class="btn-principal">Modifier</a>
</div>

<h2>Historique des soins / vaccinations</h2>

<?php if (empty($historiqueSante)): ?>
    <p>Aucun soin enregistré pour cet animal.</p>
<?php else: ?>
    <table class="tableau-donnees">
        <thead>
            <tr>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Rappel</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historiqueSante as $soin): ?>
                <tr>
                    <td><?= htmlspecialchars($soin['type']) ?></td>
                    <td><?= htmlspecialchars($soin['description'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($soin['date_evenement']) ?></td>
                    <td><?= htmlspecialchars($soin['date_rappel'] ?? '-') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="index.php?route=animals/liste">← Retour à la liste</a>
