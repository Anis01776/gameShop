<?php

declare(strict_types=1);

class ControleurUtilisateur
{
    private $utilisateurs;
    private $authentification;
    private $vue;

    public function __construct(
        Utilisateur $utilisateurs,
        Authentification $authentification,
        Vue $vue
    ) {
        $this->utilisateurs = $utilisateurs;
        $this->authentification = $authentification;
        $this->vue = $vue;
    }

    public function connexion(?string $erreur = null, string $identifiant = ''): void
    {
        $this->vue->afficher(
            'utilisateurs/connexion',
            compact('erreur', 'identifiant'),
            'Connexion'
        );
    }

    public function authentifier(array $donnees): void
    {
        $identifiant = trim((string) ($donnees['identifiant'] ?? ''));
        $motDePasse = (string) ($donnees['mot_de_passe'] ?? '');
        $utilisateur = $this->utilisateurs->trouverParIdentifiant($identifiant);

        if (
            $utilisateur === null
            || !password_verify($motDePasse, $utilisateur['mot_de_passe'])
        ) {
            $this->connexion('Identifiant ou mot de passe invalide.', $identifiant);
            return;
        }

        $this->authentification->connecter($utilisateur);
        header('Location: index.php?action=jeux');
        exit;
    }

    public function deconnecter(): void
    {
        $this->authentification->deconnecter();
        header('Location: index.php?action=jeux');
        exit;
    }

    public function afficherCreer(?string $erreur = null, string $identifiant = ''): void
    {
        $this->vue->afficher(
            'utilisateurs/creationCompte',
            compact('erreur', 'identifiant'),
            'Connexion'
        );
    }

    public function creerCompte(array $donnees): void
    {
        $identifiant = trim((string) ($donnees['identifiant'] ?? ''));
        $motDePasse = (string) ($donnees['mot_de_passe'] ?? '');
        $motDePasse2 = (string) ($donnees['mot_de_passe2'] ?? '');
        $email = (string) ($donnees['email'] ?? '');

        if ($identifiant === null) {
            $this->connexion("Identifiant invalide", '');
            return;
        }

        if ($motDePasse === null) {
            $this->connexion("Identifiant invalide", '');
            return;
        }

        if ($motDePasse2 === null) {
            $this->connexion("Identifiant invalide", '');
            return;
        }

        if ($email === null) {
            $this->connexion("Identifiant invalide", '');
            return;
        }

        $hachage = password_hash($motDePasse, PASSWORD_DEFAULT);

        $this->utilisateurs->creerUtilisateur(
            $identifiant,
            $email,
            $hachage
        );

        header('Location: index.php?action=connexion');
        exit;
    }
}
