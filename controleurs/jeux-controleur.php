<?php

declare(strict_types=1);

function afficherJeux(PDO $pdo): void
{
    $jeux =  obtenirJeux($pdo);
    $titrePage = "Boutique";

    require __DIR__ . '/../vues/jeux/index.php';
}
