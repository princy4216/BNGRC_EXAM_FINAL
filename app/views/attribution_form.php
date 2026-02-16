<h2>Attribuer un don à un besoin</h2>

<?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST" class="form">
    <div class="form-group">
        <label for="besoin_id">Besoin:</label>
        <select id="besoin_id" name="besoin_id" required>
            <option value="">Sélectionnez un besoin</option>
            <?php foreach ($besoins as $besoin): 
                if ($besoin['quantite_restante'] > 0):
            ?>
            <option value="<?php echo $besoin['id']; ?>">
                <?php echo htmlspecialchars($besoin['ville_nom']) . ' - ' . $besoin['designation'] . ' (Reste: ' . $besoin['quantite_restante'] . ')'; ?>
            </option>
            <?php 
                endif;
            endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="don_id">Don:</label>
        <select id="don_id" name="don_id" required>
            <option value="">Sélectionnez un don</option>
            <?php foreach ($dons as $don): ?>
            <option value="<?php echo $don['id']; ?>">
                <?php echo $don['designation'] . ' (Disponible: ' . $don['quantite_restante'] . ')'; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="quantite">Quantité à attribuer:</label>
        <input type="number" id="quantite" name="quantite" min="1" required>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Attribuer</button>
        <a href="/attributions" class="btn btn-secondary">Annuler</a>
    </div>
</form>