<?php ob_start(); 
$titrePage = "Acceuil";?>

<body>
    <h1>GameShop — Trouver des jeux vidéo à prix réduit</h1>
    <p>Un site créé par Belkahla Anis</p>
    <p>Le problème est le suivant : Les jeux vidéo coûtent très cher ces derniers temps et sont rarement en rabais.
        Ce site permet donc de trouver des jeux vidéo à des prix abordables.</p>
    <p>Les utilisateurs sont "Les utilisateurs de ce site sont des personnes qui aiment jouer aux jeux
        vidéo et qui souhaitent économiser de l'argent en achetant des jeux à prix réduit."</p>
    <p>Trois rôles seront présents sur ce site : 1 = Utilisateur
        2 = Administrateur
        3 = Invité</p>
</body>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/gabarit.php';