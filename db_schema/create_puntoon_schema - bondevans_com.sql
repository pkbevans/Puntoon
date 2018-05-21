SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema bondevans_com
-- -----------------------------------------------------
USE `bondevans_com` ;
Drop table IF EXISTS `bondevans_com`.`entries`;
Drop table IF EXISTS `bondevans_com`.`competitions`;
Drop table IF EXISTS `bondevans_com`.`fixtures`;
Drop table IF EXISTS `bondevans_com`.`tournaments_teams`;
Drop table IF EXISTS `bondevans_com`.`teams`;
Drop table IF EXISTS `bondevans_com`.`tournaments`;
Drop table IF EXISTS `bondevans_com`.`statuses`;
Drop table IF EXISTS `bondevans_com`.`users`;







-- -----------------------------------------------------
-- Table `bondevans_com`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bondevans_com`.`users` ;

CREATE TABLE IF NOT EXISTS `bondevans_com`.`users` (
  `id` INT NULL AUTO_INCREMENT,
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
-- Table `bondevans_com`.`tournaments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bondevans_com`.`tournaments` ;

CREATE TABLE IF NOT EXISTS `bondevans_com`.`tournaments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bondevans_com`.`fixtures`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bondevans_com`.`fixtures` ;

CREATE TABLE IF NOT EXISTS `bondevans_com`.`fixtures` (
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
    REFERENCES `bondevans_com`.`tournaments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bondevans_com`.`teams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bondevans_com`.`teams` ;

CREATE TABLE IF NOT EXISTS `bondevans_com`.`teams` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bondevans_com`.`competitions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bondevans_com`.`competitions` ;

CREATE TABLE IF NOT EXISTS `bondevans_com`.`competitions` (
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
    REFERENCES `bondevans_com`.`tournaments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bondevans_com`.`entries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bondevans_com`.`entries` ;

CREATE TABLE IF NOT EXISTS `bondevans_com`.`entries` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `competition_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
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
    REFERENCES `bondevans_com`.`competitions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bondevans_com`.`statuses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bondevans_com`.`statuses` ;

CREATE TABLE IF NOT EXISTS `bondevans_com`.`statuses` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bondevans_com`.`teams_tournaments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bondevans_com`.`teams_tournaments` ;

CREATE TABLE IF NOT EXISTS `bondevans_com`.`teams_tournaments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tournament_id` INT NOT NULL,
  `team_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `tournament_team_idx` (`tournament_id` ASC, `team_id` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
USE `bondevans_com`;

DELIMITER $$

USE `bondevans_com`$$
DROP TRIGGER IF EXISTS `bondevans_com`.`upd_goals` $$
USE `bondevans_com`$$
CREATE TRIGGER upd_goals 

AFTER UPDATE ON bondevans_com.fixtures

FOR EACH ROW BEGIN
DECLARE goalsA integer;
DECLARE goalsB integer;
	SET @goalsA := NEW.team_a_score - OLD.team_a_score;
	SET @goalsB := NEW.team_b_score - OLD.team_b_score;
	
	IF @goalsA <> 0 THEN
		update bondevans_com.entries set team_1_goals = team_1_goals+@goalsA, total_goals = total_goals+@goalsA where team_1_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
		update bondevans_com.entries set team_2_goals = team_2_goals+@goalsA, total_goals = total_goals+@goalsA where team_2_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
		update bondevans_com.entries set team_3_goals = team_3_goals+@goalsA, total_goals = total_goals+@goalsA where team_3_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
		update bondevans_com.entries set team_4_goals = team_4_goals+@goalsA, total_goals = total_goals+@goalsA where team_4_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
		update bondevans_com.entries set team_5_goals = team_5_goals+@goalsA, total_goals = total_goals+@goalsA where team_5_id = NEW.team_a_id and tournament_id = NEW.tournament_id;
	END IF;
	IF @goalsB <> 0 THEN
		update bondevans_com.entries set team_1_goals = team_1_goals+@goalsB, total_goals = total_goals+@goalsB where team_1_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
		update bondevans_com.entries set team_2_goals = team_2_goals+@goalsB, total_goals = total_goals+@goalsB where team_2_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
		update bondevans_com.entries set team_3_goals = team_3_goals+@goalsB, total_goals = total_goals+@goalsB where team_3_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
		update bondevans_com.entries set team_4_goals = team_4_goals+@goalsB, total_goals = total_goals+@goalsB where team_4_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
		update bondevans_com.entries set team_5_goals = team_5_goals+@goalsB, total_goals = total_goals+@goalsB where team_5_id = NEW.team_b_id and tournament_id = NEW.tournament_id;
	END IF;
END$$


DELIMITER ;
