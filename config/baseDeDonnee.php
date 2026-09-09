<?php

declare(strict_types=1);

function lireVariableEnv(string $nom): string
{
    $valeur = getenv($nom);

    if ($valeur === false || $valeur === '') {
        throw new RuntimeException("
    Variable d'environnement manquante : {$valeur}");
    }

    return $valeur;
}

$hote = lireVariableEnv("BD_HOST");
$port = lireVariableEnv("BD_PORT");
$nomBD = lireVariableEnv("BD_DATABASE");
$utilisateur = lireVariableEnv("BD_NOM_UTILISATEUR");
$motDePasse = lireVariableEnv("BD_MOT_DE_PASSE");

$dsn = "mysql:host={$hote};port={$port};dbname={$nomBD};charset=utf8mb4";

$pdo = new PDO($dsn, $utilisateur, $motDePasse, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);