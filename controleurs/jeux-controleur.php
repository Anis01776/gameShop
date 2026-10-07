<?php

declare(strict_types=1);

class ControleurJeux
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

    public function index(): void
    {
        $this->vue->afficher('jeux/index', [
            'jeux' => $this->jeux->obtenirJeux(),
        ], 'Jeux');
    }

    public function afficher(int $idJeux): void
    {
        $jeu = $this->jeux->obtenirJeu($idJeux);

        if ($jeu === null) {
            $this->erreurs->afficher('Article introuvable.', 404);
            return;
        }

        $this->vue->afficher('jeux/afficher', [
            'jeu' => $jeu,
            'avis' => $this->avis->obtenirAvis($idJeux),
        ], $jeu['nomJeu']);
    }
    public function afficherFormulaireModification(int $idJeux): void
    {
        $jeu = $this->jeux->obtenirJeu($idJeux);

        if ($jeu === null) {
            $this->erreurs->afficher('Jeu introuvable.', 404);
            return;
        }

        $this->vue->afficher('jeux/modifier', [
            'jeu' => $jeu,
            'erreurs' => [],
        ], 'Modifier ' . $jeu['nomJeu']);
    }

    public function mettreAJourAction(int $idJeux): void
    {
        if ($this->jeux->obtenirJeu($idJeux) === null) {
            $this->erreurs->afficher('Jeu introuvable.', 404);
            return;
        }

        $prixRabais = trim((string) ($_POST['prixRabais'] ?? ''));

        $donnees = [
            'nomJeu'     => trim((string) ($_POST['nomJeu'] ?? '')),
            'description' => trim((string) ($_POST['description'] ?? '')),
            'categorie'   => trim((string) ($_POST['categorie'] ?? '')),
            'prix'        => filter_var($_POST['prix'] ?? null, FILTER_VALIDATE_FLOAT),
            'reduction'   => isset($_POST['reduction']) ? 1 : 0,
            'prixRabais'  => $prixRabais === '' ? null : filter_var($prixRabais, FILTER_VALIDATE_FLOAT),
        ];

        $erreurs = [];

        if ($donnees['nomJeu'] === '') {
            $erreurs[] = 'Le nom est obligatoire.';
        }
        if ($donnees['categorie'] === '') {
            $erreurs[] = 'La catégorie est obligatoire.';
        }
        if ($donnees['prix'] === false || $donnees['prix'] < 0) {
            $erreurs[] = 'Le prix est invalide.';
        }
        if ($donnees['reduction'] === 1) {
            if (
                $donnees['prixRabais'] === null
                || $donnees['prixRabais'] === false
                || $donnees['prixRabais'] < 0
                || ($donnees['prix'] !== false && $donnees['prixRabais'] >= $donnees['prix'])
            ) {
                $erreurs[] = 'Le prix en rabais doit être valide et inférieur au prix normal.';
            }
        } else {
            $donnees['prixRabais'] = null; // passe à 0 si la colonne est NOT NULL
        }

        if ($erreurs !== []) {
            $this->vue->afficher('jeux/modifier', [
                'jeu' => array_merge($donnees, ['id' => $idJeux]),
                'erreurs' => $erreurs,
            ], 'Modifier le jeu');
            return;
        }

        $this->jeux->modifierJeu($idJeux, $donnees);

        header('Location: index.php?action=jeu&id=' . $idJeux);
        exit;
    }
}
