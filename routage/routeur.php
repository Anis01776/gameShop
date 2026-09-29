<?php

declare(strict_types=1);

class Routeur
{
    private $controleurJeux;
    private $controleurAvis;
    private $controleurErreur;
    private $controleurUtilisateur;

    public function __construct(
        ControleurJeux $controleurJeux,
        ControleurAvis $controleurAvis,
        ControleurErreur $controleurErreur,
        ControleurUtilisateur $controleurUtilisateur
    ) {
        $this->controleurJeux = $controleurJeux;
        $this->controleurAvis = $controleurAvis;
        $this->controleurErreur = $controleurErreur;
        $this->controleurUtilisateur = $controleurUtilisateur;
    }

    public function router(): void
    {

        $action = $_GET['action'] ?? 'jeux';

        switch ($action) {
            case 'accueil':
                require __DIR__ . '/../vues/acceuil.php';
                break;

            case 'recits':
                require __DIR__ . '/../vues/recits.php';
                break;

            case 'jeux':
                $this->controleurJeux->index();
                break;

            case 'jeu':
                $this->controleurJeux->afficher($this->lireIdGet());
                break;

            case 'commentaire-formulaire':
                $this->controleurAvis->afficherFormulaireAvis($this->lireIdGet());
                break;

            case 'confirmer-suppression':
                $this->controleurAvis->confirmerSuppressionAvis($this->lireIdGet());
                break;

            case 'supprimer-commentaire':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurAvis->supprimerAvisAction($this->lireIdPost());
                break;

            case 'avis-ajouter':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurAvis->ajouterAvisAction();
                break;

            case 'connexion':
                $this->controleurUtilisateur->connexion();
                break;

            case 'authentifier':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurUtilisateur->authentifier($_POST);
                break;

            case 'deconnexion':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurUtilisateur->deconnecter();
                break;

            case 'creer':
                $this->controleurUtilisateur->afficherCreer();
                break;

            case 'creer-compte':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurUtilisateur->creerCompte($_POST);
                break;

            case 'jeu-modifier':
                $this->controleurJeux->afficherFormulaireModification($this->lireIdGet());
                break;

            case 'jeu-mettre-a-jour':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurJeux->mettreAJourAction($this->lireIdPost());
                break;

            default:
                $this->controleurErreur->afficher('Page introuvable.', 404);
        }
    }

    private function lireIdGet(): int
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            throw new InvalidArgumentException('Identifiant invalide.', 400);
        }

        return $id;
    }

    private function lireIdPost(): int
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            throw new InvalidArgumentException('Identifiant invalide.', 400);
        }

        return $id;
    }

    private function exigerEcriture($jeton): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new RuntimeException('Méthode non permise.', 405);
        }

        if (!verifierJetonCsrf($jeton)) {
            throw new RuntimeException('Requête refusée.', 403);
        }
    }
}
