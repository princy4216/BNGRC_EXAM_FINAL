<h2>Liste des attributions</h2>

<a href="/attributions/ajouter" class="btn btn-primary">Nouvelle attribution</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ville</th>
            <th>Besoin</th>
            <th>Don</th>
            <th>Quantité</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($attributions as $attribution): ?>
        <tr>
            <td><?php echo $attribution['id']; ?></td>
            <td><?php echo htmlspecialchars($attribution['ville_nom']); ?></td>
            <td><?php echo htmlspecialchars($attribution['besoin_designation']); ?> (<?php echo $attribution['besoin_type']; ?>)</td>
            <td><?php echo htmlspecialchars($attribution['don_designation']); ?> (<?php echo $attribution['don_type']; ?>)</td>
            <td><?php echo $attribution['quantite']; ?></td>
            <td><?php echo date('d/m/Y H:i', strtotime($attribution['date_attribution'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>