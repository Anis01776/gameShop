<?php

$titre = "GameShop — Trouver des jeux vidéo à prix réduit";

$proprietaire = "Belkahla Anis";

$besoin = "Les jeux vidéo coûtent très cher ces derniers temps et sont rarement en rabais.
Ce site permet donc de trouver des jeux vidéo à des prix abordables.";

$utilisateurs = "Les utilisateurs de ce site sont des personnes qui aiment jouer aux jeux 
vidéo et qui souhaitent économiser de l'argent en achetant des jeux à prix réduit.";

$roles = "1 = Utilisateur
2 = Administrateur
3 = Invité";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titre) ?></title>
</head>

<body>
    <p>Un site créé par <?= htmlspecialchars($proprietaire) ?></p>
    <p>Le problème est le suivant : <?= htmlspecialchars($besoin) ?></p>
    <p>Les utilisateurs sont <?= htmlspecialchars($utilisateurs) ?></p>
    <p>Trois rôles seront présents sur ce site : <?= htmlspecialchars($roles) ?></p>
</body>