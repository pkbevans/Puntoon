select 
	e.name,
	e.tournament_id,
	t1.id,
	t1.name team1,
	team_1_goals,
	(
		SELECT count(*) 
		FROM fixtures f 
		WHERE f.tournament_id = e.tournament_id
		AND f.date >= CURDATE()
		AND (f.team_a_id=e.team_1_id or f.team_b_id=e.team_1_id)
	) AS team_1_fixtures,
	t2.name,
	team_2_goals,
	(
		SELECT count(*) 
		FROM fixtures f 
		WHERE f.tournament_id = e.tournament_id
		AND f.date >= CURDATE()
		AND (f.team_a_id=e.team_2_id or f.team_b_id=e.team_2_id)
	) AS team_2_fixtures,
	t3.name,
	team_3_goals,
	(
		SELECT count(*) 
		FROM fixtures f 
		WHERE f.tournament_id = e.tournament_id
		AND f.date >= CURDATE()
		AND (f.team_a_id=e.team_3_id or f.team_b_id=e.team_3_id)
	) AS team_1_fixtures,
	t4.name,
	team_4_goals,
	(
		SELECT count(*) 
		FROM fixtures f 
		WHERE f.tournament_id = e.tournament_id
		AND f.date >= CURDATE()
		AND (f.team_a_id=e.team_4_id or f.team_b_id=e.team_4_id)
	) AS team_4_fixtures,
	t5.name,
	team_5_goals,
	(
		SELECT count(*) 
		FROM fixtures f 
		WHERE f.tournament_id = e.tournament_id
		AND f.date >= CURDATE()
		AND (f.team_a_id=e.team_5_id or f.team_b_id=e.team_5_id)
	) AS team_5_fixtures,
	e.total_goals 
from entries e
	inner join teams as t1 on e.team_1_id = t1.id
	inner join teams as t2 on e.team_2_id = t2.id
	inner join teams as t3 on e.team_3_id = t3.id
	inner join teams as t4 on e.team_4_id = t4.id
	inner join teams as t5 on e.team_5_id = t5.id
where competition_id=4
order by total_goals desc