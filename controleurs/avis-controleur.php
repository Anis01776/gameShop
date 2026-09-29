<?php

declare(strict_types=1);

class ControleurAvis
{
    private $jeux;
    private $avis;
    private $vue;
    private $erreurs;

    public function __construct(
        Jeux $jeux,
        Avis $avis,
        Vue $vue,
        ControleurErreur $erreurs
    ) {
        $this->jeux = $jeux;
        $this->avis = $avis;
        $this->vue = $vue;
        $this->erreurs = $erreurs;
    }
    public function afficherFormulaireAvis(int $idJeu, array $erreurs = [], array $valeurs = []): void
    {
        $jeu = $this->jeux->obtenirJeu($idJeu);

        if ($jeu === null) {
            $this->erreurs->afficher("Jeu introuvable", 404);
            return;
        }

        $this->vue->afficher(
            'avis/ajouter',
            [
                'jeu' => $jeu,
                'erreurs' => $erreurs,
                'valeurs' => $valeurs,
            ],
            "Ajouter un Avis"
        );
    }
    public function ajouterAvisAction(): void
    {
        $commentaire  = trim((string) ($_POST['commentaire'] ?? ''));
        $etoiles = (int)($_POST['etoiles'] ?? 0);
        $idJeu = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $erreurs = [];

        if ($idJeu === null || $idJeu === false) {
            $this->erreurs->afficher("Identifiant invalide", 400);
            return;
        }

        if ($this->jeux->obtenirJeu($idJeu) === null) {
            $this->erreurs->afficher("Jeu introuvable", 404);
            return;
        }

        if (mb_strlen($commentaire) <= 0 || mb_strlen($commentaire) > 255) {
            $erreurs['commentaire'] = 'Le commentaire doit contenir de 1 à 255 caractères.';
        }

        if ($etoiles < 0 || $etoiles > 5) {
            $erreurs['etoiles'] = 'Le nom detoiles doit etre entre 0 et 5';
        }

        if ($erreurs !== []) {
            $this->afficherFormulaireAvis($idJeu, $erreurs, [
                'commentaire' => $commentaire,
                'etoiles' => $etoiles,
            ]);
            return;
        }
        $this->avis->ajouterAvis($commentaire, $etoiles, $idJeu);
        header('Location: index.php?action=jeu&id=' . $idJeu);
        exit;
    }
    function confirmerSuppressionAvis(int $idAvis): void
    {
        $avis = $this->avis->obtenir1Avis($idAvis);
        if ($avis === null) {
            $this->erreurs->afficher("Commentaire introuvable", 404);
            return;
        }
        $this->vue->afficher('avis/confirmer-suppresion', ['avis' => $avis, 'titrePage' => "Confirmer la suppression"]);
    }
    public function supprimerAvisAction(int $idAvis): void
    {
        $avis = $this->avis->obtenir1Avis($idAvis);
        if ($avis === null) {
            $this->erreurs->afficher("Commentaire introuvable", 404);
        }
        $this->avis->supprimerAvis($idAvis);
        header('Location: index.php?action=jeu&id=' . $avis['idJeux']);
        exit;
    }
}
