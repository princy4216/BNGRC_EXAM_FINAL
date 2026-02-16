<h2>Tableau de bord</h2>

<div class="stats-container">
    <div class="stat-card">
        <h3>Villes</h3>
        <p class="stat-number"><?php echo $stats['villes']; ?></p>
    </div>
    
    <div class="stat-card">
        <h3>Besoins</h3>
        <p class="stat-number"><?php echo $stats['besoins']['total']; ?></p>
        <p>Total: <?php echo $stats['besoins']['quantite_totale']; ?></p>
        <p>Reste: <?php echo $stats['besoins']['reste_total']; ?></p>
    </div>
    
    <div class="stat-card">
        <h3>Dons</h3>
        <p class="stat-number"><?php echo $stats['dons']['total']; ?></p>
        <p>Total: <?php echo $stats['dons']['quantite_totale']; ?></p>
        <p>Reste: <?php echo $stats['dons']['reste_total']; ?></p>
    </div>
    
    <div class="stat-card">
        <h3>Attributions</h3>
        <p class="stat-number"><?php echo $stats['attributions']['total']; ?></p>
        <p>Total distribué: <?php echo $stats['attributions']['quantite_totale']; ?></p>
    </div>
</div>

<h3>Statistiques par ville</h3>
<table class="table">
    <thead>
        <tr>
            <th>Ville</th>
            <th>Région</th>
            <th>Besoins totaux</th>
            <th>Dons reçus</th>
            <th>Nombre de besoins</th>
            <th>Satisfaction</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($statsParVille as $stat): ?>
        <tr>
            <td><?php echo htmlspecialchars($stat['nom']); ?></td>
            <td><?php echo htmlspecialchars($stat['region']); ?></td>
            <td><?php echo $stat['total_besoins']; ?></td>
            <td><?php echo $stat['total_dons_recus']; ?></td>
            <td><?php echo $stat['nombre_besoins']; ?></td>
            <td>
                <?php 
                if ($stat['total_besoins'] > 0) {
                    $pourcentage = ($stat['total_dons_recus'] / $stat['total_besoins']) * 100;
                    echo number_format($pourcentage, 2) . '%';
                } else {
                    echo '-';
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="dashboard-grid">
    <div class="dashboard-col">
        <h3>Besoins non satisfaits</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Ville</th>
                    <th>Besoin</th>
                    <th>Reste</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($besoinsNonSatisfaits as $besoin): ?>
                <tr>
                    <td><?php echo htmlspecialchars($besoin['ville_nom']); ?></td>
                    <td><?php echo htmlspecialchars($besoin['designation']); ?></td>
                    <td class="warning"><?php echo $besoin['quantite_restante']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="dashboard-col">
        <h3>Dernières attributions</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Ville</th>
                    <th>Besoin</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dernieresAttributions as $attribution): ?>
                <tr>
                    <td><?php echo date('d/m', strtotime($attribution['date_attribution'])); ?></td>
                    <td><?php echo htmlspecialchars($attribution['ville']); ?></td>
                    <td><?php echo htmlspecialchars($attribution['besoin']); ?></td>
                    <td><?php echo $attribution['quantite']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>