<?php

declare(strict_types=1);

function obtenirAvis(PDO $pdo, int $idJeux): array
{
    $requete = $pdo->prepare(
        'SELECT *
        FROM avis
        WHERE idJeux = :idJeux'
    );

    $requete->execute(['idJeux' => $idJeux]);

    return $requete->fetchAll();
}

function ajouterAvis(PDO $pdo,/* int $idUser,*/ string $commentaire, int $etoiles, int $idJeux): int
{
    $requete = $pdo->prepare(
        'INSERT INTO avis (`idUtilisateur`, `commentaire`, `etoiles`, `idJeux`)
        VALUES (1,:commentaire,:etoiles,:idJeux)'
    );

    $requete->execute([
        // 'idUser' => $idUser,
        'commentaire' => $commentaire,
        'etoiles' => $etoiles,
        "idJeux" => $idJeux
    ]);
    return (int) $pdo->lastInsertId();
}

function obtenir1Avis(PDO $pdo, int $idavis): ?array
{
    $requete = $pdo->prepare(
        'SELECT *
         FROM avis
         WHERE idavis = :idavis'
    );
    $requete->execute(['idavis' => $idavis]);

    $avis = $requete->fetch();

    return $avis ?: null;
}

function supprimerAvis(PDO $pdo, int $idavis): bool
{
    $requete = $pdo->prepare(
        'DELETE FROM avis WHERE idavis = :idavis'
    );
    $requete->execute(['idavis' => $idavis]);

    return $requete->rowCount() === 1;
}
