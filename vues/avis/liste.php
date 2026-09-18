<section>
    <h2>Avis</h2>
    <p>
        <a href="index.php?action=commentaire-formulaire&idJeux=<?= (int) $jeu['idJeux'] ?>">
            Ajouter un commentaire
        </a>
    </p>
    <?php if ($avis === []): ?>
        <p>Aucun commentaire</p>
        <?php else:
        foreach ($avis as $avi): ?>
            <article>
                <p><?= nl2br(htmlspecialchars($avi['commentaire'], ENT_QUOTES, 'UTF-8')) ?></p>
                <small>
                    <?= htmlspecialchars($avi['etoiles']) ?>
                </small>
            </article>
            <p>
                <a href="index.php?action=confirmer-suppression&idavis=<?= (int) $avi['idavis'] ?>">
                    Supprimer cet avis
                </a>

            </p>
        <?php endforeach; ?>
    <?php endif; ?>
</section>