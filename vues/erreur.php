<?php ob_start(); ?>

<h1>Erreur</h1>
<p>Une erreur est survenue</p>
<?php
$contenu = ob_get_clean();
require __DIR__ . '/gabarit.php';
