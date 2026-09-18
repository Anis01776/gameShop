<?php ob_start(); ?>

<div class="jeux-container">
    <?php foreach ($jeux as $jeu): ?>
        <div class="jeu-carte">
            <h1><a href="index.php?action=jeu&idJeux=<?= (int)$jeu['idJeux'] ?>">
                    <?= htmlspecialchars((string)$jeu['nomJeux']) ?></a></h1>
            <p class="description"><?= htmlspecialchars($jeu['description']) ?></p>

            <?php if ($jeu['reduction'] === 1): ?>
                <span class="reduction-badge">En réduction</span>
                <p class="prix-rabais"><?= htmlspecialchars((string)$jeu['prixRabais']) ?> $</p>
            <?php else : ?>
                <p class="pas-reduc">Pas de réduction</p>
                <p class="prix-normal"><?= htmlspecialchars((string)$jeu['prix']) ?> $</p>
            <?php endif ?>

            <span class="categorie"><?= htmlspecialchars($jeu['categorie']) ?></span>
        </div>
    <?php endforeach; ?>
</div>
<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';
