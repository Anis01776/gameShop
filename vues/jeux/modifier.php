<?php
$erreurs = $erreurs ?? [];
$e = fn($valeur): string => htmlspecialchars((string) ($valeur ?? ''), ENT_QUOTES, 'UTF-8');
$categories = ['Action', 'Aventure', 'RPG', 'Sport', 'Stratégie']; // adapte à tes catégories
?>

<h1>Modifier le jeu</h1>

<?php if ($erreurs !== []): ?>
    <ul class="erreurs">
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= $e($erreur) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="index.php?action=jeu-mettre-a-jour" method="post" class="formulaire-jeu">
    <input type="hidden" name="jeton_csrf" value="<?= $e(jetonCsrf()) ?>">
    <input type="hidden" name="id" value="<?= (int) $jeu['id'] ?>">

    <div>
        <label for="nomJeu">Nom</label>
        <input type="text" id="nomJeu" name="nomJeu" maxlength="100" required
            value="<?= $e($jeu['nomJeu'] ?? '') ?>">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"><?= $e($jeu['description'] ?? '') ?></textarea>
    </div>

    <div>
        <label for="categorie">Catégorie</label>
        <select id="categorie" name="categorie" required>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= $e($categorie) ?>"
                    <?= ($jeu['categorie'] ?? '') === $categorie ? 'selected' : '' ?>>
                    <?= $e($categorie) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="prix">Prix ($)</label>
        <input type="number" id="prix" name="prix" step="0.01" min="0" required
            value="<?= $e($jeu['prix'] ?? '') ?>">
    </div>

    <div>
        <label>
            <input type="checkbox" name="reduction" value="1"
                <?= (int) ($jeu['reduction'] ?? 0) === 1 ? 'checked' : '' ?>>
            En réduction
        </label>
    </div>

    <div>
        <label for="prixRabais">Prix en rabais ($)</label>
        <input type="number" id="prixRabais" name="prixRabais" step="0.01" min="0"
            value="<?= $e($jeu['prixRabais'] ?? '') ?>">
    </div>

    <button type="submit">Enregistrer</button>
    <a href="index.php?action=jeu&id=<?= (int) $jeu['id'] ?>">Annuler</a>
</form>