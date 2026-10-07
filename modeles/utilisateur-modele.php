<?php

declare(strict_types=1);

require_once __DIR__ . '/modele.php';

class Utilisateur extends Modele
{
    public function trouverParIdentifiant(string $identifiant): ?array
    {
        $utilisateur = $this->executer(
            'SELECT *
             FROM utilisateurs
             WHERE nomUtilisateur  = :nomUtilisateur',
            ['nomUtilisateur' => $identifiant]
        )->fetch();

        return $utilisateur ?: null;
    }

    public function creerUtilisateur(
        string $nomUtilisateur,
        string $email,
        string $hachage
    ): int {
        $this->executer(
            'INSERT INTO utilisateurs (nomUtilisateur, email, mdp)
         VALUES (:nomUtilisateur, :email, :mdp)',
            [
                'nomUtilisateur' => $nomUtilisateur,
                'email' => $email,
                'mdp' => $hachage
            ]
        );

        return (int) $this->pdo->lastInsertId();
    }
}
