<?php

declare(strict_types=1);

require_once __DIR__ . '/Modele.php';

class Utilisateur extends Modele
{
    public function trouverParIdentifiant(string $identifiant): ?array
    {
        $utilisateur = $this->executer(
            'SELECT *
             FROM utilisateurs
             WHERE identifiant = :identifiant',
            ['identifiant' => $identifiant]
        )->fetch();

        return $utilisateur ?: null;
    }

    public function creerUtilisateur(
        string $identifiant,
        string $email,
        string $hachage
    ): int {
        $this->executer(
            'INSERT INTO utilisateurs (identifiant, email, mot_de_passe)
         VALUES (:identifiant, :email, :mdp)',
            [
                'identifiant' => $identifiant,
                'email' => $email,
                'mdp' => $hachage
            ]
        );

        return (int) $this->pdo->lastInsertId();
    }
}
