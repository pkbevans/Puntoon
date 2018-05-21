use bondevans_com;
alter table tournaments add column start_date date default '2017-01-01' not null;

update tournaments set start_date = "2016-10-01", finish_date = "2016-10-31" where id = 1;
update tournaments set start_date = "2016-11-01", finish_date = "2016-11-30" where id = 2;
update tournaments set start_date = "2016-12-01", finish_date = "2016-12-31" where id = 3;
update tournaments set start_date = "2017-01-01", finish_date = "2017-01-31" where id = 4;
update tournaments set start_date = "2017-02-01", finish_date = "2017-02-28" where id = 5;
update tournaments set start_date = "2017-03-01", finish_date = "2017-03-31" where id = 6;
update tournaments set start_date = "2017-04-01", finish_date = "2017-04-30" where id = 7;
update tournaments set start_date = "2017-05-01", finish_date = "2017-05-31" where id = 8;
