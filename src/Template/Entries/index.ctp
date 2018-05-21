<div class="entries index">
	<h2><?= __("Competition Entries"); ?></h2>
	<table>
	<tr>
			<th><?= $this->Paginator->sort('competition_id'); ?></th>
			<th><?= $this->Paginator->sort('user_id'); ?></th>
			<th><?= $this->Paginator->sort('team_1_id'); ?></th>
			<th><?= $this->Paginator->sort('team_1_goals'); ?></th>
			<th><?= $this->Paginator->sort('team_2_id'); ?></th>
			<th><?= $this->Paginator->sort('team_2_goals'); ?></th>
			<th><?= $this->Paginator->sort('team_3_id'); ?></th>
			<th><?= $this->Paginator->sort('team_3_goals'); ?></th>
			<th><?= $this->Paginator->sort('team_4_id'); ?></th>
			<th><?= $this->Paginator->sort('team_4_goals'); ?></th>
			<th><?= $this->Paginator->sort('team_5_id'); ?></th>
			<th><?= $this->Paginator->sort('team_5_goals'); ?></th>
			<th><?= $this->Paginator->sort('total_goals'); ?></th>
	</tr>
	<!-- <?php debug($entries);?>-->
	<?php foreach ($entries as $entry): ?>
	<tr>
		<td><?= $this->Html->link($entry->competition->name, ['controller' => 'competitions', 'action' => 'view', $entry->competition->id]); ?></td>
		<td><?= $this->Html->link($entry->user->username, ['controller' => 'users', 'action' => 'view', $entry->user->id]); ?></td>
		<td><?= $this->Html->link($entry->team1->name, ['controller' => 'teams', 'action' => 'view', $entry->team1->id]); ?></td>
		<td><?= h($entry->team_1_goals); ?>&nbsp;</td>
		<td><?= $this->Html->link($entry->team2->name, ['controller' => 'teams', 'action' => 'view', $entry->team2->id]); ?></td>
		<td><?= h($entry->team_2_goals); ?>&nbsp;</td>
		<td><?= $this->Html->link($entry->team3->name, ['controller' => 'teams', 'action' => 'view', $entry->team3->id]); ?></td>
		<td><?= h($entry->team_3_goals); ?>&nbsp;</td>
		<td><?= $this->Html->link($entry->team4->name, ['controller' => 'teams', 'action' => 'view', $entry->team4->id]); ?></td>
		<td><?= h($entry->team_4_goals); ?>&nbsp;</td>
		<td><?= $this->Html->link($entry->team5->name, ['controller' => 'teams', 'action' => 'view', $entry->team5->id]); ?></td>
		<td><?= h($entry->team_5_goals); ?>&nbsp;</td>
		<td><?= h($entry->total_goals); ?>&nbsp;</td>
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
