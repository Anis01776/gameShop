<?php

declare(strict_types=1);

function afficherAcceuil(): void
{
    $titrePage = "Acceuil";

    $titre = "GameShop — Trouver des jeux vidéo à prix réduit";

    $proprietaire = "Belkahla Anis";

    $besoin = "Les jeux vidéo coûtent très cher ces derniers temps et sont rarement en rabais.
    Ce site permet donc de trouver des jeux vidéo à des prix abordables.";

    $utilisateurs = "Les utilisateurs de ce site sont des personnes qui aiment jouer aux jeux 
    vidéo et qui souhaitent économiser de l'argent en achetant des jeux à prix réduit.";

    $roles = "1 = Utilisateur
    2 = Administrateur
    3 = Invité";

    require __DIR__ . '../../vues/acceuil.php';
}
