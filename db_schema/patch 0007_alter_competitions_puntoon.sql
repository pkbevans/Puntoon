use puntoon;
alter table competitions drop column closing_entry_date;
alter table competitions add column closing_entry_date DATETIME default '2017-01-01 23:59:59' not null;
