<h2>Liste des dons</h2>

<a href="/dons/ajouter" class="btn btn-primary">Ajouter un don</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Désignation</th>
            <th>Quantité</th>
            <th>Reste</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dons as $don): ?>
        <tr>
            <td><?php echo $don['id']; ?></td>
            <td><?php echo $don['type']; ?></td>
            <td><?php echo htmlspecialchars($don['designation']); ?></td>
            <td><?php echo $don['quantite']; ?></td>
            <td class="<?php echo $don['quantite_restante'] > 0 ? 'success' : 'secondary'; ?>">
                <?php echo $don['quantite_restante']; ?>
            </td>
            <td><?php echo date('d/m/Y', strtotime($don['date_don'])); ?></td>
            <td>
                <a href="/dons/editer/<?php echo $don['id']; ?>" class="btn-edit">Modifier</a>
                <a href="/dons/supprimer/<?php echo $don['id']; ?>" class="btn-delete" onclick="return confirm('Supprimer ce don?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>