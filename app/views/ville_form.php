<?php $title = isset($ville) ? 'Modifier ville' : 'Ajouter ville'; ?>

<h2><?php echo $title; ?></h2>

<?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST" class="form">
    <div class="form-group">
        <label for="nom">Nom de la ville:</label>
        <input type="text" id="nom" name="nom" value="<?php echo isset($ville) ? htmlspecialchars($ville['nom']) : ''; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="region">Région:</label>
        <input type="text" id="region" name="region" value="<?php echo isset($ville) ? htmlspecialchars($ville['region']) : ''; ?>" required>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="/villes" class="btn btn-secondary">Annuler</a>
    </div>
</form>