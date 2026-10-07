SET NAMES utf8mb4;
USE `gameshop_bd`;

  -- -----------------------------------------------------
  -- Table `GameShop_BD`.`avis`
  -- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `avis` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idUtilisateur` INT NOT NULL,
  `commentaire` VARCHAR(255) NOT NULL,
  `etoiles` INT NOT NULL,
  `idJeux` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_avis_Jeux_idx` (`idJeux` ASC),
  INDEX `fk_avis_Utilisateurs1_idx` (`idUtilisateur` ASC),
  CONSTRAINT `fk_avis_Jeux`
    FOREIGN KEY (`idJeux`)
    REFERENCES `jeux` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avis_Utilisateurs1`
    FOREIGN KEY (`idUtilisateur`)
    REFERENCES `utilisateurs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;