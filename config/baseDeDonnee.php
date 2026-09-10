<?php

declare(strict_types=1);

function lireVariableEnv(string $nom): string
{
    $valeur = getenv($nom);

    if ($valeur === false || $valeur === '') {
        throw new RuntimeException("
    Variable d'environnement manquante : {$nom}");
    }

    return $valeur;
}

$hote = lireVariableEnv("DB_HOST");
$port = lireVariableEnv("DB_PORT");
$nomBD = lireVariableEnv("DB_DATABASE");
$utilisateur = lireVariableEnv("DB_USERNAME");
$motDePasse = lireVariableEnv("DB_PASSWORD");

$dsn = "mysql:host={$hote};port={$port};dbname={$nomBD};charset=utf8mb4";

$pdo = new PDO($dsn, $utilisateur, $motDePasse, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);