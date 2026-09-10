<?php

declare(strict_types=1);

$titrePage = 'Messages du chapitre 2';

$messages = [];
$messageErreur = null;
try {
    require __DIR__ . '/config/baseDeDonnee.php';

    $requete = $pdo->prepare(
        'SELECT idavis,etoiles
         FROM avis'
    );
    $requete->execute();
    $messages = $requete->fetchAll();
} catch (Throwable $exception) {
    error_log($exception->getMessage());
    $messageErreur = "Impossible de charger le message" . $exception->getMessage();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?></title>
</head>

<body>
    <?php if ($messageErreur !== null): ?>
        <p><strong>Erreur :</strong>
            <?= htmlspecialchars($messageErreur, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php elseif ($messages === []): ?>
        <p>Aucun message n'est disponible.</p>
    <?php else: ?>
        <?php foreach ($messages as $message): ?>
            <article>
                <h2><?= htmlspecialchars($message['titre'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= nl2br(htmlspecialchars($message['contenu'], ENT_QUOTES, 'UTF-8')) ?></p>
                <small>
                    Publié le
                    <?= htmlspecialchars($message['date_cree'], ENT_QUOTES, 'UTF-8') ?>
                </small>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>