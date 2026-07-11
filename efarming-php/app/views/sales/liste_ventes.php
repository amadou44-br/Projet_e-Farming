<h1>Ventes</h1>

<a href="index.php?route=sales/ajouter" class="btn-principal">+ Enregistrer une vente</a>

<?php if (empty($ventes)): ?>
    <p>Aucune vente enregistrée.</p>
<?php else: ?>
    <table class="tableau-donnees">
        <thead>
            <tr>
                <th>Animal</th>
                <th>Acheteur</th>
                <th>Prix</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventes as $vente): ?>
                <tr>
                    <td><?= htmlspecialchars($vente['animal_identifiant']) ?></td>
                    <td><?= htmlspecialchars($vente['acheteur']) ?></td>
                    <td><?= number_format((float) $vente['prix'], 2) ?> €</td>
                    <td><?= htmlspecialchars($vente['date_vente']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
