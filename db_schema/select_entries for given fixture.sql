select
tournaments.id,
tournaments.name,
competitions.id,
competitions.name,
entries.id,
entries.name,
entries.team_1_id,
entries.team_2_id,
entries.team_3_id,
entries.team_4_id,
entries.team_5_id
from entries
inner join competitions on entries.competition_id = competitions.id
inner join tournaments on tournaments.id = competitions.tournament_id

where tournaments.id  = 2
and (entries.team_1_id = 20
or entries.team_2_id = 20
or entries.team_3_id = 20
or entries.team_4_id = 20
or entries.team_5_id = 20)