<?php

declare(strict_types=1);
try {
    require __DIR__ . '/config/baseDeDonnee.php';
    require __DIR__ . '/modeles/jeux-modele.php';
    require __DIR__ . '/controleurs/jeux-controleur.php';
    afficherJeux($pdo);
} catch (Throwable $erreur) {
    var_dump($erreur->getMessage());
    $titrePage = "Erreur";
    require __DIR__ . '/vues/erreur.php';
}
