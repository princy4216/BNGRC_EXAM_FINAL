<?php $title = isset($don) ? 'Modifier don' : 'Ajouter don'; ?>

<h2><?php echo $title; ?></h2>

<?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST" class="form">
    <div class="form-group">
        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="nature" <?php echo (isset($don) && $don['type'] == 'nature') ? 'selected' : ''; ?>>Nature (riz, huile...)</option>
            <option value="materiel" <?php echo (isset($don) && $don['type'] == 'materiel') ? 'selected' : ''; ?>>Matériel (tôle, clou...)</option>
            <option value="argent" <?php echo (isset($don) && $don['type'] == 'argent') ? 'selected' : ''; ?>>Argent</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="designation">Désignation:</label>
        <input type="text" id="designation" name="designation" value="<?php echo isset($don) ? htmlspecialchars($don['designation']) : ''; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="quantite">Quantité:</label>
        <input type="number" id="quantite" name="quantite" value="<?php echo isset($don) ? $don['quantite'] : ''; ?>" required>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="/dons" class="btn btn-secondary">Annuler</a>
    </div>
</form>