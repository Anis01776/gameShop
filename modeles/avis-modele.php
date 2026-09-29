<?php

declare(strict_types=1);

class Avis extends Modele
{
    public function obtenirAvis(int $idJeux): array
    {
        return $this->executer(
            'SELECT *
        FROM avis
        WHERE idJeux = :idJeux',
            ['idJeux' => $idJeux]
        )->fetchAll();
    }

    public function ajouterAvis(/* int $idUser,*/string $commentaire, int $etoiles, int $idJeux): int
    {
        $this->executer('INSERT INTO avis (`idUtilisateur`, `commentaire`, `etoiles`, `idJeux`)
        VALUES (1,:commentaire,:etoiles,:idJeux)', [
            // 'idUser' => $idUser,
            'commentaire' => $commentaire,
            'etoiles' => $etoiles,
            "idJeux" => $idJeux
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    public function obtenir1Avis(int $idAvis): ?array
    {
        $avis = $this->executer('SELECT *
         FROM avis
         WHERE id = :id', ['id' => $idAvis])->fetch();

        return $avis ?: null;
    }

    public function supprimerAvis(int $idAvis): bool
    {
        return  $this->executer('DELETE FROM avis WHERE id = :id', ['id' => $idAvis])->rowCount() === 1;
    }
}
