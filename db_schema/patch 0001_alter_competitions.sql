alter table competitions 
add column entry_fee float default 0.0 not null,
drop column winner_id;