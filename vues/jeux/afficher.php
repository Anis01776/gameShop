<article>
    <h1><?= htmlspecialchars($jeu['nomJeux']) ?></h1>
    <p><?= htmlspecialchars($jeu['description']) ?></p>
    <?php if ($jeu['reduction'] === 1): ?>
        <span>En réduction</span>
        <p><?= htmlspecialchars((string)$jeu['prixRabais']) ?> $</p>
    <?php else : ?>
        <p>Pas de réduction</p>
        <p><?= htmlspecialchars((string)$jeu['prix']) ?> $</p>
    <?php endif ?>

    <span><?= htmlspecialchars($jeu['categorie']) ?></span>
</article>
<a href="index.php?action=jeu-modifier&id=<?= (int) $jeu['id'] ?>">Modifier</a>

<?php require __DIR__ . '/../avis/liste.php';
