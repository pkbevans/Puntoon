<div class="leaders index">
	<h2><?= __($user->username . ' - My Punts'); ?></h2>
    <table class="filter">
	<tr>
			<td><?php 
			echo $this->Form->create('filter', ['type' => 'get', 'url' => ['action' => 'mine']]);?>
			&nbsp;Show finished competitions&nbsp;
			<?php 
				if(empty ($showAll)){
					echo $this->Form->checkbox('showAll', ['selected'=>'false']);
				}else{
					echo $this->Form->checkbox('showAll', ['checked'=>'true']);
				}
			?>
			<?= $this->Form->button(__('Filter'));
				$this->Form->end(); ?></td>
		</tr>
	</table>
	<table>
	<tr>
			<th><?= $this->Paginator->sort('Competition_id', 'Competition'); ?></th>
			<th><?= $this->Paginator->sort('Entry_id', 'Entry Name'); ?></th>
			<th><?= $this->Paginator->sort('Team1_id', 'Team 1'); ?></th>
			<th><?= $this->Paginator->sort('Team1_Goals', 'Goals'); ?></th>
			<th><?= $this->Paginator->sort('Team2_id', 'Team 2'); ?></th>
			<th><?= $this->Paginator->sort('Team2_Goals', 'Goals'); ?></th>
			<th><?= $this->Paginator->sort('Team3_id', 'Team 3'); ?></th>
			<th><?= $this->Paginator->sort('Team3_Goals', 'Goals'); ?></th>
			<th><?= $this->Paginator->sort('Team4_id', 'Team 4'); ?></th>
			<th><?= $this->Paginator->sort('Team4_Goals', 'Goals'); ?></th>
			<th><?= $this->Paginator->sort('Team5_id', 'Team 5'); ?></th>
			<th><?= $this->Paginator->sort('Team5_Goals', 'Goals'); ?></th>
			<th><?= $this->Paginator->sort('Total_Goals', 'Total'); ?></th>
			<th class="actions"><?= __('Actions'); ?></th>
	</tr>
	<?php foreach ($entries as $entry): ?>
	<tr>
		<td><?= $this->Html->link($entry->competition->name, array('controller' => 'competitions', 'action' => 'view', $entry->competition->id)); ?></td>
		<td><?= h($entry->name); ?>&nbsp;</td>
		<td><?= $this->Html->link($entry->team1->name, array('controller' => 'teamsTournaments', 'action' => 'view', $entry->tournament_id, $entry->team_1_id)); ?></td>
		<td><?= h($entry->team_1_goals); ?>&nbsp;</td>
		<td><?= $this->Html->link($entry->team2->name, array('controller' => 'teamsTournaments', 'action' => 'view', $entry->tournament_id, $entry->team_2_id)); ?></td>
		<td><?= h($entry->team_2_goals); ?>&nbsp;</td>
		<td><?= $this->Html->link($entry->team3->name, array('controller' => 'teamsTournaments', 'action' => 'view', $entry->tournament_id, $entry->team_3_id)); ?></td>
		<td><?= h($entry->team_3_goals); ?>&nbsp;</td>
		<td><?= $this->Html->link($entry->team4->name, array('controller' => 'teamsTournaments', 'action' => 'view', $entry->tournament_id, $entry->team_4_id)); ?></td>
		<td><?= h($entry->team_4_goals); ?>&nbsp;</td>
		<td><?= $this->Html->link($entry->team5->name, array('controller' => 'teamsTournaments', 'action' => 'view', $entry->tournament_id, $entry->team_5_id)); ?></td>
		<td><?= h($entry->team_5_goals); ?>&nbsp;</td>
		<td><?= h($entry->total_goals); ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('Leader Board'), array('controller' => 'entries', 'action' => 'leaderBoard', $entry->competition->id)); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
	</div>
