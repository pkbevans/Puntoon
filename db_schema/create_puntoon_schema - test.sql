-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema puntoon
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema puntoon
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `puntoon` DEFAULT CHARACTER SET utf8 ;
USE `puntoon` ;

-- -----------------------------------------------------
-- Table `puntoon`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puntoon`.`users` (
  `id` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(250) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `role` VARCHAR(20) NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `puntoon`.`tournaments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puntoon`.`tournaments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `puntoon`.`fixtures`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puntoon`.`fixtures` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tournament_id` INT NOT NULL,
  `date` DATETIME NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `team_a_id` INT NOT NULL,
  `team_a_score` INT NOT NULL DEFAULT 0,
  `team_b_score` INT NOT NULL DEFAULT 0,
  `team_b_id` INT NOT NULL,
  `status_id` INT NOT NULL DEFAULT 0,
  UNIQUE INDEX `txn_code_UNIQUE` (`id` ASC),
  PRIMARY KEY (`id`),
  INDEX `FIXTURE_TOURNAMENT_idx` (`tournament_id` ASC),
  INDEX `date_idx` (`date` ASC),
  CONSTRAINT `FIXTURE_TOURNAMENT`
    FOREIGN KEY (`tournament_id`)
    REFERENCES `puntoon`.`tournaments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `puntoon`.`teams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puntoon`.`teams` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `puntoon`.``
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puntoon`.`` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tournament_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `organiser_id` INT NOT NULL,
  `winner_id` INT NOT NULL DEFAULT 0,
  `invite_only` TINYINT(1) NOT NULL DEFAULT 0,
  `prize_percent` INT NOT NULL DEFAULT 0,
  `closing_entry_date` DATE NOT NULL,
  `finish_date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `TOURNAMENT_idx` (`tournament_id` ASC),
  CONSTRAINT `TOURNAMENT`
    FOREIGN KEY (`tournament_id`)
    REFERENCES `puntoon`.`tournaments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `puntoon`.`entries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puntoon`.`entries` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competition_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `team_1_id` INT NOT NULL,
  `team_2_id` INT NOT NULL,
  `team_3_id` INT NOT NULL,
  `team_4_id` INT NOT NULL,
  `team_5_id` INT NOT NULL,
  `status_id` INT NOT NULL DEFAULT 0,
  `tournament_id` INT NOT NULL,
  `team_1_goals` INT NOT NULL DEFAULT 0,
  `team_2_goals` INT NOT NULL DEFAULT 0,
  `team_3_goals` INT NOT NULL DEFAULT 0,
  `team_4_goals` INT NOT NULL DEFAULT 0,
  `team_5_goals` INT NOT NULL DEFAULT 0,
  `total_goals` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `COMPETITION_idx` (`competition_id` ASC),
  INDEX `USER_idx` (`user_id` ASC),
  INDEX `total_goals_idx` (`total_goals` ASC),
  CONSTRAINT `COMPETITION`
    FOREIGN KEY (`competition_id`)
    REFERENCES `puntoon`.`` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `puntoon`.`statuses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puntoon`.`statuses` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `puntoon`.`teams_tournaments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `puntoon`.`teams_tournaments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tournament_id` INT NOT NULL,
  `team_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `tournament_team_idx` (`tournament_id` ASC, `team_id` ASC))
ENGINE = InnoDB;

USE `puntoon`;

DELIMITER $$
USE `puntoon`$$
CREATE TRIGGER upd_goals 

AFTER UPDATE ON puntoon.fixtures

FOR EACH ROW BEGIN
DECLARE goalsA integer;
DECLARE goalsB integer;
	SET @goalsA := NEW.team_a_score - OLD.team_a_score;
	SET @goalsB := NEW.team_b_score - OLD.team_b_score;
	
	IF @goalsA <> 0 THEN
		update puntoon.entries set team_1_goals = team_1_goals+@goalsA, total_goals = total_goals+@goalsA where team_1_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
		update puntoon.entries set team_2_goals = team_2_goals+@goalsA, total_goals = total_goals+@goalsA where team_2_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
		update puntoon.entries set team_3_goals = team_3_goals+@goalsA, total_goals = total_goals+@goalsA where team_3_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
		update puntoon.entries set team_4_goals = team_4_goals+@goalsA, total_goals = total_goals+@goalsA where team_4_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
		update puntoon.entries set team_5_goals = team_5_goals+@goalsA, total_goals = total_goals+@goalsA where team_5_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
	END IF;
	IF @goalsB <> 0 THEN
		update puntoon.entries set team_1_goals = team_1_goals+@goalsB, total_goals = total_goals+@goalsB where team_1_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
		update puntoon.entries set team_2_goals = team_2_goals+@goalsB, total_goals = total_goals+@goalsB where team_2_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
		update puntoon.entries set team_3_goals = team_3_goals+@goalsB, total_goals = total_goals+@goalsB where team_3_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
		update puntoon.entries set team_4_goals = team_4_goals+@goalsB, total_goals = total_goals+@goalsB where team_4_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
		update puntoon.entries set team_5_goals = team_5_goals+@goalsB, total_goals = total_goals+@goalsB where team_5_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
	END IF;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
