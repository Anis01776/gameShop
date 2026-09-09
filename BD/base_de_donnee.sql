-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema GameShop_BD
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema GameShop_BD
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `GameShop_BD` DEFAULT CHARACTER SET utf8 ;
USE `GameShop_BD` ;

-- -----------------------------------------------------
-- Table `GameShop_BD`.`Utilisateurs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameShop_BD`.`Utilisateurs` (
  `idUtilisateur` INT NOT NULL AUTO_INCREMENT,
  `nomUtilisateur` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `mdp` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE INDEX `Utilisateurscol_UNIQUE` (`nomUtilisateur` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `idUtilisateur_UNIQUE` (`idUtilisateur` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GameShop_BD`.`Jeux`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameShop_BD`.`Jeux` (
  `idJeux` INT NOT NULL AUTO_INCREMENT,
  `nomJeux` VARCHAR(255) NOT NULL,
  `prix` DOUBLE NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `reduction` TINYINT NOT NULL,
  `prixRabais` DOUBLE UNSIGNED NULL,
  `categorie` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idJeux`),
  UNIQUE INDEX `idJeux_UNIQUE` (`idJeux` ASC) VISIBLE,
  UNIQUE INDEX `nomJeux_UNIQUE` (`nomJeux` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GameShop_BD`.`avis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameShop_BD`.`avis` (
  `idavis` INT NOT NULL AUTO_INCREMENT,
  `idUtilisateur` INT NOT NULL,
  `commentaire` VARCHAR(255) NOT NULL,
  `etoiles` INT NOT NULL,
  `idJeux` INT NOT NULL,
  PRIMARY KEY (`idavis`),
  UNIQUE INDEX `idavis_UNIQUE` (`idavis` ASC) VISIBLE,
  INDEX `fk_avis_Jeux_idx` (`idJeux` ASC) VISIBLE,
  INDEX `fk_avis_Utilisateurs1_idx` (`idUtilisateur` ASC) VISIBLE,
  CONSTRAINT `fk_avis_Jeux`
    FOREIGN KEY (`idJeux`)
    REFERENCES `GameShop_BD`.`Jeux` (`idJeux`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avis_Utilisateurs1`
    FOREIGN KEY (`idUtilisateur`)
    REFERENCES `GameShop_BD`.`Utilisateurs` (`idUtilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GameShop_BD`.`panier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameShop_BD`.`panier` (
  `idpanier` INT NOT NULL AUTO_INCREMENT,
  `idJeux` INT NOT NULL,
  `idUtilisateur` INT NOT NULL,
  PRIMARY KEY (`idpanier`),
  UNIQUE INDEX `idpanier_UNIQUE` (`idpanier` ASC) VISIBLE,
  INDEX `fk_panier_Jeux1_idx` (`idJeux` ASC) VISIBLE,
  INDEX `fk_panier_Utilisateurs1_idx` (`idUtilisateur` ASC) VISIBLE,
  CONSTRAINT `fk_panier_Jeux1`
    FOREIGN KEY (`idJeux`)
    REFERENCES `GameShop_BD`.`Jeux` (`idJeux`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_panier_Utilisateurs1`
    FOREIGN KEY (`idUtilisateur`)
    REFERENCES `GameShop_BD`.`Utilisateurs` (`idUtilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GameShop_BD`.`bibliotheque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameShop_BD`.`bibliotheque` (
  `idbibliotheque` INT NOT NULL AUTO_INCREMENT,
  `idJeux` INT NOT NULL,
  `idUtilisateur` INT NOT NULL,
  PRIMARY KEY (`idbibliotheque`),
  UNIQUE INDEX `idbibliotheque_UNIQUE` (`idbibliotheque` ASC) VISIBLE,
  INDEX `fk_bibliotheque_Jeux1_idx` (`idJeux` ASC) VISIBLE,
  INDEX `fk_bibliotheque_Utilisateurs1_idx` (`idUtilisateur` ASC) VISIBLE,
  CONSTRAINT `fk_bibliotheque_Jeux1`
    FOREIGN KEY (`idJeux`)
    REFERENCES `GameShop_BD`.`Jeux` (`idJeux`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bibliotheque_Utilisateurs1`
    FOREIGN KEY (`idUtilisateur`)
    REFERENCES `GameShop_BD`.`Utilisateurs` (`idUtilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
