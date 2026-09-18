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

function obtenirJeu(PDO $pdo, int $idJeux): ?array
{
    $requete = $pdo->prepare(
        'SELECT * 
        FROM jeux
        WHERE idJeux = :idJeux'
    );
    $requete->execute(['idJeux' => $idJeux]);

    $jeu = $requete->fetch();

    return $jeu ?: null;
}
