<?php

declare(strict_types=1);

require_once __DIR__ . '/config/securite.php';
require_once __DIR__ . '/Modeles/jeux-modele.php';
require_once __DIR__ . '/Modeles/avis-modele.php';
require_once __DIR__ . '/Controleurs/jeux-controleur.php';
require_once __DIR__ . '/Controleurs/erreur-controleur.php';
require_once __DIR__ . '/controleurs/avis-controleur.php';

demarrerSession();

$action = $_GET['action'] ?? 'jeux';

try {
    require_once __DIR__ . '/config/baseDeDonnee.php';

    switch ($action) {
        case 'commentaire-formulaire':
            $idJeux = filter_input(INPUT_GET, 'idJeux', FILTER_VALIDATE_INT);

            if ($idJeux === false || $idJeux === null) {
                afficherErreur('Identifiant invalide.', 400);
                break;
            }

            afficherFormulaireAvis($pdo, $idJeux);
            break;

        case 'avis-ajouter':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                afficherErreur('Méthode non permise.', 405);
                break;
            }

            if (!verifierJetonCsrf($_POST['jeton_csrf'] ?? null)) {
                afficherErreur('Requête refusée.', 403);
                break;
            }

            ajouterAvisAction($pdo);
            break;
        case 'confirmer-suppression':
            $idavis = filter_input(INPUT_GET, 'idavis', FILTER_VALIDATE_INT);

            if ($idavis === false || $idavis === null) {
                afficherErreur('Identifiant invalide.', 400);
                break;
            }

            confirmerSuppressionAvis($pdo, $idavis);
            break;

        case 'supprimer-commentaire':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                afficherErreur('Méthode non permise.', 405);
                break;
            }

            if (!verifierJetonCsrf($_POST['jeton_csrf'] ?? null)) {
                afficherErreur('Requête refusée.', 403);
                break;
            }

            $idavis = filter_input(INPUT_POST, 'idavis', FILTER_VALIDATE_INT);

            if ($idavis === false || $idavis === null) {
                afficherErreur('Identifiant invalide.', 400);
                break;
            }

            supprimerAvisAction($pdo, $idavis);
            break;
        case 'jeu':
            $idJeux = filter_input(INPUT_GET, 'idJeux', FILTER_VALIDATE_INT);

            if ($idJeux === false || $idJeux === null) {
                afficherErreur('Identifiant invalide.', 400);
                break;
            }

            afficherJeu($pdo, $idJeux);
            break;

        case 'jeux':
            afficherJeux($pdo);
            break;

        case 'recits':
            require_once __DIR__ . '/vues/recits.php';
            break;
        
        case 'accueil':
            require_once __DIR__ . '/vues/acceuil.php';
            break;
            
        default:
            afficherErreur('Page introuvable.', 404);
    }
} catch (Throwable $exception) {
    error_log($exception->getMessage());
    afficherErreur('Une erreur empêche le traitement de la demande.', 500);
}
