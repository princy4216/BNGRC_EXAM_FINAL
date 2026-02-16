<?php $title = isset($besoin) ? 'Modifier besoin' : 'Ajouter besoin'; ?>

<h2><?php echo $title; ?></h2>

<?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST" class="form">
    <div class="form-group">
        <label for="ville_id">Ville:</label>
        <select id="ville_id" name="ville_id" required>
            <option value="">Sélectionnez une ville</option>
            <?php foreach ($villes as $ville): ?>
            <option value="<?php echo $ville['id']; ?>" <?php echo (isset($besoin) && $besoin['ville_id'] == $ville['id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($ville['nom']); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="nature" <?php echo (isset($besoin) && $besoin['type'] == 'nature') ? 'selected' : ''; ?>>Nature (riz, huile...)</option>
            <option value="materiel" <?php echo (isset($besoin) && $besoin['type'] == 'materiel') ? 'selected' : ''; ?>>Matériel (tôle, clou...)</option>
            <option value="argent" <?php echo (isset($besoin) && $besoin['type'] == 'argent') ? 'selected' : ''; ?>>Argent</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="designation">Désignation:</label>
        <input type="text" id="designation" name="designation" value="<?php echo isset($besoin) ? htmlspecialchars($besoin['designation']) : ''; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="quantite">Quantité:</label>
        <input type="number" id="quantite" name="quantite" value="<?php echo isset($besoin) ? $besoin['quantite'] : ''; ?>" required>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="/besoins" class="btn btn-secondary">Annuler</a>
    </div>
</form>