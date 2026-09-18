<?php ob_start(); ?>

<h1>Confirmer la suppression</h1>

<p>
    Voulez-vous supprimer le commentaire de
    <strong><?= htmlspecialchars($avis['idavis'], ENT_QUOTES, 'UTF-8') ?></strong>?
</p>

<blockquote>
    <?= nl2br(htmlspecialchars($avis['commentaire'], ENT_QUOTES, 'UTF-8')) ?>
</blockquote>

<form action="index.php?action=supprimer-commentaire" method="post">
    <input type="hidden" name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="idavis" value="<?= (int) $avis['idavis'] ?>">
    <button type="submit">Confirmer la suppression</button>
    <a href="index.php?action=jeu&idJeux=<?= (int) $avis['idJeux'] ?>">
        Annuler
    </a>
</form>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';
