-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: bondevans.com.mysql:3306
-- Generation Time: Nov 29, 2016 at 11:52 AM
-- Server version: 5.5.53-MariaDB-1~wheezy
-- PHP Version: 5.4.45-0+deb7u5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bondevans_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE IF NOT EXISTS `fixtures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(45) NOT NULL,
  `team_a_id` int(11) NOT NULL,
  `team_a_score` int(11) NOT NULL DEFAULT '0',
  `team_b_score` int(11) NOT NULL DEFAULT '0',
  `team_b_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `txn_code_UNIQUE` (`id`),
  KEY `FIXTURE_TOURNAMENT_idx` (`tournament_id`),
  KEY `date_idx` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`id`, `tournament_id`, `date`, `description`, `team_a_id`, `team_a_score`, `team_b_score`, `team_b_id`, `status_id`) VALUES
(40, 2, '2016-11-05 15:00:00', 'November Fixtures', 2, 1, 2, 15, 2),
(41, 2, '2016-11-05 15:00:00', 'November Fixtures', 3, 3, 2, 5, 2),
(42, 2, '2016-11-05 15:00:00', 'November Fixtures', 10, 1, 1, 12, 2),
(43, 2, '2016-11-05 15:00:00', 'November Fixtures', 20, 1, 1, 14, 2),
(44, 2, '2016-11-05 17:30:00', 'November Fixtures', 4, 5, 0, 6, 2),
(45, 2, '2016-11-06 12:00:00', 'November Fixtures', 1, 1, 1, 17, 2),
(46, 2, '2016-11-06 14:15:00', 'November Fixtures', 7, 2, 1, 13, 2),
(47, 2, '2016-11-06 14:15:00', 'November Fixtures', 9, 6, 1, 18, 2),
(48, 2, '2016-11-06 15:00:00', 'November Fixtures', 16, 1, 3, 11, 2),
(49, 2, '2016-11-06 16:30:00', 'November Fixtures', 8, 1, 2, 19, 2),
(50, 2, '2016-11-19 12:30:00', 'November Fixtures', 11, 1, 1, 1, 2),
(51, 2, '2016-11-19 15:00:00', 'November Fixtures', 5, 1, 2, 10, 2),
(52, 2, '2016-11-19 15:00:00', 'November Fixtures', 6, 1, 1, 16, 2),
(53, 2, '2016-11-19 15:00:00', 'November Fixtures', 13, 0, 0, 9, 2),
(54, 2, '2016-11-19 15:00:00', 'November Fixtures', 14, 0, 1, 2, 2),
(55, 2, '2016-11-19 15:00:00', 'November Fixtures', 15, 3, 0, 7, 2),
(56, 2, '2016-11-19 15:00:00', 'November Fixtures', 18, 2, 1, 8, 2),
(57, 2, '2016-11-19 17:30:00', 'November Fixtures', 17, 3, 2, 20, 2),
(58, 2, '2016-11-20 16:00:00', 'November Fixtures', 12, 0, 1, 4, 2),
(59, 2, '2016-11-21 20:00:00', 'November Fixtures', 19, 4, 0, 3, 2),
(60, 2, '2016-11-26 12:30:00', 'November Fixtures', 3, 1, 2, 10, 2),
(61, 2, '2016-11-26 15:00:00', 'November Fixtures', 7, 1, 1, 19, 2),
(62, 2, '2016-11-26 15:00:00', 'November Fixtures', 8, 2, 2, 12, 2),
(63, 2, '2016-11-26 15:00:00', 'November Fixtures', 9, 2, 0, 15, 2),
(64, 2, '2016-11-26 15:00:00', 'November Fixtures', 16, 5, 4, 5, 2),
(65, 2, '2016-11-26 17:30:00', 'November Fixtures', 4, 2, 1, 17, 2),
(66, 2, '2016-11-27 12:00:00', 'November Fixtures', 18, 0, 1, 14, 2),
(67, 2, '2016-11-27 14:15:00', 'November Fixtures', 1, 3, 1, 2, 2),
(68, 2, '2016-11-27 16:30:00', 'November Fixtures', 11, 1, 1, 20, 2),
(69, 2, '2016-11-27 16:30:00', 'November Fixtures', 13, 1, 0, 6, 2);

--
-- Triggers `fixtures`
--
DROP TRIGGER IF EXISTS `upd_goals`;
DELIMITER //
CREATE TRIGGER `upd_goals` AFTER UPDATE ON `fixtures`
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
END
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD CONSTRAINT `FIXTURE_TOURNAMENT` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
