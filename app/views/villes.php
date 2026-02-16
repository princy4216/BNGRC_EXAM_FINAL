<h2>Liste des villes</h2>

<a href="/villes/ajouter" class="btn btn-primary">Ajouter une ville</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Région</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($villes as $ville): ?>
        <tr>
            <td><?php echo $ville['id']; ?></td>
            <td><?php echo htmlspecialchars($ville['nom']); ?></td>
            <td><?php echo htmlspecialchars($ville['region']); ?></td>
            <td>
                <a href="/villes/editer/<?php echo $ville['id']; ?>" class="btn-edit">Modifier</a>
                <a href="/villes/supprimer/<?php echo $ville['id']; ?>" class="btn-delete" onclick="return confirm('Supprimer cette ville?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>