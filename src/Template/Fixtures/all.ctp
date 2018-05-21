<div>
    <h3><?= __('Fixtures') ?></h3>
	<table>
	<thead>
		<tr>
			<th>Date</th>
			<th>Home Team</th>
			<th></th>
			<th></th>
			<th>Away Team</th>
			<th>Time</th>
		</tr>
	</thead>
	<?php foreach ($fixtures as $fixture): 	?>
	<tr>
		<td><?= $this->Html->link($this->Time->format($fixture->date,"Y-MM-dd"), ['action' => 'edit', $fixture->id]); ?></td>
		<td><?= $fixture->team_a->name;?></td>
		<td><?= $fixture->team_a_score;?></td>
		<td><?= $fixture->team_b_score;?></td>
		<td><?= $fixture->team_b->name;?></td>
		<td><?= $this->Time->format($fixture->date, 'HH:mm');?></td>
	</tr>
	<?php endforeach; ?>
	</table>    
</div>
