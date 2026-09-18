<?php ob_start(); ?>

<?php $premierChampErreur = array_key_first($erreurs); ?>

<h1>Ajouter un commentaire</h1>
<p>Article : <?= htmlspecialchars($jeu['nomJeux'], ENT_QUOTES, 'UTF-8') ?></p>

<?php if ($erreurs !== []): ?>
    <div id="resume-erreurs" role="alert">
        <h2>Le formulaire contient des erreurs</h2>
        <ul>
            <?php foreach ($erreurs as $erreur): ?>
                <li><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="index.php?action=avis-ajouter" method="POST">
    <input type="hidden" name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">


    <label for="etoiles">Nombre d'etoiles</label>
    <input type="number" id="etoiles" name="etoiles" required min="0" max="5"
        <?= isset($erreurs['etoiles']) ? 'aria-invalid="true" aria-describedby="erreur-etoiles"' : '' ?>
        <?= $premierChampErreur === 'etoiles' ? 'autofocus' : '' ?>
        value="<?= htmlspecialchars($valeurs['etoiles'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    <?php if (isset($erreurs['etoiles'])): ?>
        <p id="erreur-etoiles"><?= htmlspecialchars($erreurs['etoiles'], ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <label for="commentaire">Entrez votre commentaire</label>
    <textarea id="commentaire" name="commentaire" required maxlength="255"
        <?= isset($erreurs['commentaire']) ? 'aria-invalid="true" aria-describedby="erreur-commentaire"' : '' ?>
        <?= $premierChampErreur === 'commentaire' ? 'autofocus' : '' ?>><?= htmlspecialchars($valeurs['commentaire'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    <?php if (isset($erreurs['commentaire'])): ?>
        <p id="erreur-commentaire"><?= htmlspecialchars($erreurs['commentaire'], ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <input type="hidden" name="idJeux" value="<?= (int)$jeu['idJeux'] ?>">

    <button type="submit">Ajouter</button>
    <a href="index.php?action=jeu&id=<?= (int) $jeu['idJeux'] ?>">Annuler</a>
</form>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';
