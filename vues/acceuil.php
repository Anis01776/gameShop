<?php ob_start(); ?>

<body>
    <h1></h1>
    <p>Un site créé par <?= htmlspecialchars($proprietaire, ENT_QUOTES, 'UTF-8') ?></p>
    <p>Le problème est le suivant : <?= htmlspecialchars($besoin, ENT_QUOTES, 'UTF-8') ?></p>
    <p>Les utilisateurs sont <?= htmlspecialchars($utilisateurs, ENT_QUOTES, 'UTF-8') ?></p>
    <p>Trois rôles seront présents sur ce site : <?= htmlspecialchars($roles, ENT_QUOTES, 'UTF-8') ?></p>
</body>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/gabarit.php';
