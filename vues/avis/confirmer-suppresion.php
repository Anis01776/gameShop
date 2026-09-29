<h1>Confirmer la suppression</h1>

<p>
    Voulez-vous supprimer le commentaire de
    <strong><?= htmlspecialchars($avis['id'], ENT_QUOTES, 'UTF-8') ?></strong>?
</p>

<blockquote>
    <?= nl2br(htmlspecialchars($avis['commentaire'], ENT_QUOTES, 'UTF-8')) ?>
</blockquote>

<form action="index.php?action=supprimer-commentaire" method="post">
    <input type="hidden" name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="id" value="<?= (int) $avis['id'] ?>">
    <button type="submit">Confirmer la suppression</button>
    <a href="index.php?action=jeu&id=<?= (int) $avis['idJeux'] ?>">
        Annuler
    </a>
</form>