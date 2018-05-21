insert into entries (competition_id, user_id, name, team_1_id, team_2_id, team_3_id, team_4_id, team_5_id, status_id)
select 4, user_id, name, team_1_id, team_2_id, team_3_id, team_4_id, team_5_id, 1
from entries
where competition_id=1