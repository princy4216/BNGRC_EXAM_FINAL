<h2>Liste des besoins</h2>

<a href="/besoins/ajouter" class="btn btn-primary">Ajouter un besoin</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ville</th>
            <th>Type</th>
            <th>Désignation</th>
            <th>Quantité</th>
            <th>Reste</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($besoins as $besoin): ?>
        <tr>
            <td><?php echo $besoin['id']; ?></td>
            <td><?php echo htmlspecialchars($besoin['ville_nom']); ?></td>
            <td><?php echo $besoin['type']; ?></td>
            <td><?php echo htmlspecialchars($besoin['designation']); ?></td>
            <td><?php echo $besoin['quantite']; ?></td>
            <td class="<?php echo $besoin['quantite_restante'] > 0 ? 'warning' : 'success'; ?>">
                <?php echo $besoin['quantite_restante']; ?>
            </td>
            <td><?php echo date('d/m/Y', strtotime($besoin['date_besoin'])); ?></td>
            <td>
                <a href="/besoins/editer/<?php echo $besoin['id']; ?>" class="btn-edit">Modifier</a>
                <a href="/besoins/supprimer/<?php echo $besoin['id']; ?>" class="btn-delete" onclick="return confirm('Supprimer ce besoin?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>