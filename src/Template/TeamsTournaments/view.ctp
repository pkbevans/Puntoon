<div class="teamsTournaments view">
<h2><?= __($teamsTournament->team->name);?>&nbsp;:&nbsp;<?= $this->Html->link($teamsTournament->tournament->name,['controller' => 'tournaments', 'action' => 'view', $teamsTournament->tournament->id] ); ?></h2>
</div>
<div class="related">
	<h3><?= __('Fixtures'); ?></h3>
	<?php if (!empty($fixtures)): ?>
	<table>
	<?php 
		$prevDate='';
		foreach ($fixtures as $fixture): 
		if($prevDate!=$this->Time->format($fixture->date, 'YYYYMMdd')){
			echo "<tr>".
			"<td colspan=\"5\" class=\"fixture_date\">". 
			$this->Time->format($fixture->date, "EEEE, MMM dd yyyy")."</td>".
			"</tr>";
			$prevDate=$this->Time->format($fixture->date, 'YYYYMMdd');
		}
		?>
	<tr>
		<td class="home_team"><?= $fixture->team_a->name;?></td>
		<?php if($fixture->status->id != 0):?>
		<td class="home_team_score"><?= $fixture->team_a_score;?></td>
  		<td class="vs">-</td>
		<td class="away_team_score"><?= $fixture->team_b_score;?></td>
		<?php else:?>
		<td class="home_team_score">&nbsp;</td>
  		<td class="vs">vs</td>
		<td class="away_team_score">&nbsp;</td>
		<?php endif;?>
		<td class="away_team"><?= $fixture->team_b->name;?></td>
	</tr>
			<?php endforeach; ?>
	</table>
	<?php endif; ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
