<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="css/dev.css">
</head>

<body>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="recits.php">Recits</a>
        <a href="jeux.php">Jeux</a>
    </nav>
    <main>
        <?= $contenu ?>
    </main>
</body>

</html>