SET NAMES utf8mb4;
USE `gameshop_bd`;

-- -----------------------------------------------------
-- Table `GameShop_BD`.`Utilisateurs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nomUtilisateur` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `mdp` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Utilisateurscol_UNIQUE` (`nomUtilisateur` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;

INSERT INTO utilisateurs (nomUtilisateur, email, mdp)
VALUES
  ('AnisB', 'anis.bel@example.com', '$2y$10$SoL4X0e/ZkbPV3rRIYGttuOybbwwwJHS0Nxnq3R9OCyDf35jz/h42');