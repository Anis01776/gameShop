<?php

declare(strict_types=1);

require_once __DIR__ . '/config/baseDeDonnee.php';
require_once __DIR__ . '/config/securite.php';
require_once __DIR__ . '/modeles/jeux-modele.php';
require_once __DIR__ . '/modeles/avis-modele.php';
require_once __DIR__ . '/Vues/Vue.php';
require_once __DIR__ . '/controleurs/jeux-controleur.php';
require_once __DIR__ . '/controleurs/avis-controleur.php';
require_once __DIR__ . '/controleurs/erreur-controleur.php';
require_once __DIR__ . '/routage/routeur.php';
require_once __DIR__ . '/services/Authentification.php';
require_once __DIR__ . '/modeles/utilisateur-modele.php';
require_once __DIR__ . '/controleurs/utilisateur-controleur.php';

$authentification = new Authentification();
$vue = new Vue($authentification);
$utilisateurs = new Utilisateur($pdo);
$controleurUtilisateur = new ControleurUtilisateur(
    $utilisateurs,
    $authentification,
    $vue
);


$jeux = new Jeux($pdo);
$avis = new Avis($pdo);
$vue = new Vue($authentification);
$controleurErreur = new ControleurErreur($vue);
$controleurJeux = new ControleurJeux($jeux, $avis, $vue, $controleurErreur);
$controleurAvis = new ControleurAvis($jeux, $avis, $vue, $controleurErreur);
$routeur = new Routeur($controleurJeux, $controleurAvis, $controleurErreur, $controleurUtilisateur);

try {
    $routeur->router();
}catch (Throwable $e) {
    http_response_code(200); // temporaire
    echo get_class($e) . ' : ' . $e->getMessage();
    exit;
}
