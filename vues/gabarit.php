<?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/'; ?>
<base href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>">

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="css/dev.css">
</head>

<body>

    <?php if ($utilisateurCourant !== null): ?>
        <span><?= htmlspecialchars($utilisateurCourant['nom'], ENT_QUOTES, 'UTF-8') ?></span>
        <form action="index.php?action=deconnexion" method="post">
            <input type="hidden" name="jeton_csrf"
                value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit">Se déconnecter</button>
        </form>
    <?php else: ?>
        <a href="index.php?action=connexion">Connexion</a>
    <?php endif; ?>


    <nav>
        <a href="index.php?action=accueil">Accueil</a>
        <a href="index.php?action=recits">Recits</a>
        <a href="index.php">Jeux</a>
    </nav>
    <main>
        <?= $contenu ?>
    </main>
</body>

</html>