<?php

declare(strict_types=1);

function obtenirAvi(PDO $pdo, int $idJeu): array
{
    $requete = $pdo->prepare(
        'SELECT * 
        FROM avis
        WHERE idJeux = :idJeux'
    );
    $requete->execute(['idJeux' => $idJeu]);

    return $requete->fetchAll();
}

function afficherJeu(PDO $pdo, int $idJeux): void
{
    $jeu = obtenirJeu($pdo, $idJeux);
    if ($jeu === null) {
        afficherErreur("Article introuvable", 404);
        return;
    }
    $avis = obtenirAvis($pdo, $idJeux);
    $titrePage = $jeu['nomJeux'];

    require __DIR__ . '/../vues/jeux/afficher.php';
}

function afficherFormulaireAvis(PDO $pdo, int $idJeu, array $erreurs = [], array $valeurs = []): void
{
    $jeu = obtenirJeu($pdo, $idJeu);

    if ($jeu === null) {
        afficherErreur('Article introuvable.', 404);
        return;
    }

    $titrePage = 'Ajouter un Avis';
    require __DIR__ . '/../vues/avis/ajouter.php';
}

function ajouterAvisAction(PDO $pdo): void
{
    $commentaire  = trim((string) ($_POST['commentaire'] ?? ''));
    $etoiles = (int)($_POST['etoiles'] ?? 0);
    $idJeux = filter_input(INPUT_POST, 'idJeux', FILTER_VALIDATE_INT);
    $erreurs = [];

    if ($idJeux === null || $idJeux === false) {
        afficherErreur('Identifiant invalide.', 400);
        return;
    }

    if (obtenirJeu($pdo, $idJeux) === null) {
        afficherErreur('Article introuvable.', 404);
        return;
    }

    if (mb_strlen($commentaire) <= 0 || mb_strlen($commentaire) > 255) {
        $erreurs['commentaire'] = 'Le commentaire doit contenir de 1 à 255 caractères.';
    }

    if ($etoiles < 0 || $etoiles > 5) {
        $erreurs['etoiles'] = 'Le nom detoiles doit etre entre 0 et 5';
    }

    if ($erreurs !== []) {
        afficherFormulaireAvis($pdo, $idJeux, $erreurs, [
            'commentaire' => $commentaire,
            'etoiles' => $etoiles,
        ]);
        return;
    }
    ajouterAvis($pdo, $commentaire, $etoiles, $idJeux);
    header('Location: index.php?action=jeu&idJeux=' . $idJeux);
    exit;
}

function confirmerSuppressionAvis(PDO $pdo, int $idavis): void
{
    $avis = obtenir1Avis($pdo, $idavis);

    if ($avis === null) {
        afficherErreur('Commentaire introuvable.', 404);
        return;
    }

    $titrePage = 'Confirmer la suppression';
    require __DIR__ . '/../Vues/avis/confirmer-suppresion.php';
}

function supprimerAvisAction(PDO $pdo, int $idavis): void
{
    $avis = obtenir1Avis($pdo, $idavis);

    if ($avis === null) {
        afficherErreur('Commentaire introuvable.', 404);
        return;
    }

    supprimerAvis($pdo, $idavis);

    header('Location: index.php?action=jeu&idJeux=' . $avis['idJeux']);
    exit;
}
