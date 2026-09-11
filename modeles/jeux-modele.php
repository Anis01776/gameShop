<?php

declare(strict_types=1);

function obtenirJeux(PDO $pdo): array
{

    $requete = $pdo->prepare(
        'SELECT *
        FROM jeux'
    );

    $requete->execute();
    return $requete->fetchAll();
}
