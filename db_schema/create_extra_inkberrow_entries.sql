use puntoon;

INSERT into users
(`firstname`,`surname`,`username`,`email`,`role`,`password`)
values
('Tim','Ross','tross','tross@junk.com','punter','$2y$10$kaC6zOJn.3j7O9iVfpoPkOx7L9KwJcgupPnMtkh26TW5FP0oqmV1K'),
('Amanda','Wallis','awallis','awallis@junk.com','punter','$2y$10$kaC6zOJn.3j7O9iVfpoPkOx7L9KwJcgupPnMtkh26TW5FP0oqmV1K'),
('Mark','Broadhurst','mbroadhurst','mbroadhurst@junk.com','punter','$2y$10$kaC6zOJn.3j7O9iVfpoPkOx7L9KwJcgupPnMtkh26TW5FP0oqmV1K'),
('Dave','Chamberlain','dchamberlain','dchamberlain@junk.com','punter','$2y$10$kaC6zOJn.3j7O9iVfpoPkOx7L9KwJcgupPnMtkh26TW5FP0oqmV1K'),
('Ed','Wallis','ewallis','ewwallis@junk.com','punter','$2y$10$kaC6zOJn.3j7O9iVfpoPkOx7L9KwJcgupPnMtkh26TW5FP0oqmV1K'),
('Tony','Pickering','tpickering','tpickering@junk.com','punter','$2y$10$kaC6zOJn.3j7O9iVfpoPkOx7L9KwJcgupPnMtkh26TW5FP0oqmV1K'),
('Stuart','Freeman','sfreeman','sfreeman@junk.com','punter','$2y$10$kaC6zOJn.3j7O9iVfpoPkOx7L9KwJcgupPnMtkh26TW5FP0oqmV1K');

-- December entries
INSERT INTO entries
(`tournament_id`,`competition_id`,`user_id`,`name`,`team_1_id`,`team_2_id`,`team_3_id`,`team_4_id`,`team_5_id`,`status_id`)
VALUES
(3,3,42,'Tim Ross 1',10,6,15,7,12,0),
(3,3,42,'Tim Ross 2',7,5,3,1,18,0);

