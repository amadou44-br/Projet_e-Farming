<h1>Tableau de bord</h1>

<div class="grille-stats">
    <div class="carte-stat">
        <h3><?= $nbAnimaux ?></h3>
        <p>Animaux enregistrés</p>
    </div>
    <div class="carte-stat">
        <h3><?= $nbVentes ?></h3>
        <p>Ventes réalisées</p>
    </div>
    <div class="carte-stat">
        <h3><?= number_format($totalVentes, 2) ?> €</h3>
        <p>Total des ventes</p>
    </div>
</div>

<h2>Prochains rappels de vaccination</h2>

<?php if (empty($rappels)): ?>
    <p>Aucun rappel à venir.</p>
<?php else: ?>
    <ul class="liste-rappels">
        <?php foreach ($rappels as $rappel): ?>
            <li>
                <strong><?= htmlspecialchars($rappel['animal_identifiant']) ?></strong>
                — <?= htmlspecialchars($rappel['type']) ?>
                le <?= htmlspecialchars($rappel['date_rappel']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
