<?php include 'layout.php'; ?>

<?php if($success == 'attribution_added'): ?>
    <div class="alert alert-success">Attribution effectuée avec succès!</div>
<?php endif; ?>

<h2>Tableau de Bord - Vue d'ensemble</h2>

<div class="card-container">
    <div class="card">
        <h3>Villes</h3>
        <p><?= $stats['total_villes'] ?></p>
    </div>
    <div class="card">
        <h3>Besoins</h3>
        <p><?= $stats['total_besoins'] ?></p>
    </div>
    <div class="card">
        <h3>Dons</h3>
        <p><?= $stats['total_dons'] ?></p>
    </div>
    <div class="card">
        <h3>Attributions</h3>
        <p><?= $stats['total_attributions'] ?></p>
    </div>
</div>

<h3>Besoins par ville</h3>
<table>
    <thead>
        <tr>
            <th>Ville</th>
            <th>Région</th>
            <th>Besoin</th>
            <th>Type</th>
            <th>Quantité demandée</th>
            <th>Quantité attribuée</th>
            <th>Reste</th>
            <th>Progression</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($besoins as $b): ?>
            <?php 
            $pourcentage = $b['quantite_demandee'] > 0 
                ? round(($b['quantite_attribuee'] / $b['quantite_demandee']) * 100, 1)
                : 0;
            ?>
            <tr>
                <td><?= htmlspecialchars($b['ville']) ?></td>
                <td><?= htmlspecialchars($b['region']) ?></td>
                <td><?= htmlspecialchars($b['designation']) ?></td>
                <td>
                    <span style="background: <?= $b['type'] == 'argent' ? '#28a745' : ($b['type'] == 'nature' ? '#ffc107' : '#17a2b8') ?>; 
                                 color: white; padding: 3px 8px; border-radius: 3px;">
                        <?= htmlspecialchars($b['type']) ?>
                    </span>
                </td>
                <td><?= number_format($b['quantite_demandee']) ?></td>
                <td><?= number_format($b['quantite_attribuee']) ?></td>
                <td><?= number_format($b['quantite_restante']) ?></td>
                <td>
                    <div style="background: #e0e0e0; border-radius: 5px; height: 20px; width: 100%;">
                        <div style="background: #667eea; width: <?= $pourcentage ?>%; height: 100%; border-radius: 5px;"></div>
                    </div>
                    <small><?= $pourcentage ?>%</small>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Historique des attributions</h3>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Ville</th>
            <th>Besoin</th>
            <th>Don</th>
            <th>Quantité</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($attributions as $a): ?>
            <tr>
                <td><?= date('d/m/Y H:i', strtotime($a['date_attribution'])) ?></td>
                <td><?= htmlspecialchars($a['ville']) ?></td>
                <td><?= htmlspecialchars($a['besoin']) ?></td>
                <td><?= htmlspecialchars($a['don']) ?></td>
                <td><?= number_format($a['quantite']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>