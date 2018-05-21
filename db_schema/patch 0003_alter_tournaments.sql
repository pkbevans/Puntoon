use puntoon;
alter table tournaments 
add column finish_date date default '2017-01-31' not null;