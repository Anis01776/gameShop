<?php

declare(strict_types=1);

require_once __DIR__ . "/modele.php";

class Jeux extends Modele
{

    public function obtenirJeux(): array
    {
        return $this->executer(
            'SELECT *
        FROM jeux'
        )->fetchAll();
    }

    public function obtenirJeu(int $idJeux): ?array
    {
        $jeu = $this->executer('SELECT * 
        FROM jeux
        WHERE id = :id', ['id' => $idJeux])->fetch();

        return $jeu ?: null;
    }
    public function modifierJeu(int $idJeux, array $d): void
    {
        $this->executer(
            'UPDATE jeux
         SET nomJeu = :nomJeu,
             description = :description,
             categorie = :categorie,
             prix = :prix,
             reduction = :reduction,
             prixRabais = :prixRabais
         WHERE id = :id',
            [
                'nomJeu'     => $d['nomJeu'],
                'description' => $d['description'],
                'categorie'   => $d['categorie'],
                'prix'        => $d['prix'],
                'reduction'   => $d['reduction'],
                'prixRabais'  => $d['prixRabais'],
                'id'          => $idJeux,
            ]
        );
    }
}
