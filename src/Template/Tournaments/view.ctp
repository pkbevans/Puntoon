<div class="tournaments view">
<h2><?= __('Tournament: '. $tournament->name); ?></h2>
	<dl>
		<dt><?= __('Start Date'); ?></dt>
		<dd><?= h($this->Time->format($tournament->start_date, "MMM dd yyyy"));?>&nbsp;</dd>
		<dt><?= __('End Date'); ?></dt>
		<dd><?= h($this->Time->format($tournament->finish_date, "MMM dd yyyy")); ?>&nbsp;</dd>
	</dl>
</div>
<div class="related">
	<h3><?= __('Competitions'); ?></h3>
	<?php if (!empty($competitions)): ?>
	<table>
	<tr>
		<th><?= $this->Paginator->sort('Name'); ?></th>
		<th><?= $this->Paginator->sort('Organiser'); ?></th>
        <th><?= $this->Paginator->sort('invite_only', 'Invitation Only') ?></th>
		<th><?= $this->Paginator->sort('entry_fee') ?></th>
		<th><?= $this->Paginator->sort('Prize Percent'); ?></th>
		<th><?= $this->Paginator->sort('closing_entry_date'); ?></th>
		<th><?= $this->Paginator->sort('finish_date'); ?></th>
		<th scope="col" class="actions"><?= __('Actions') ?></th>
		</tr>
	<?php foreach ($competitions as $competition): ?>
		<tr>
			<td><?= $this->Html->link(__($competition->name), ['controller' => 'competitions', 'action' => 'view', $competition->id]); ?></td>
			<td><?= $competition->organiser->username; ?></td>
			<td><?php if($competition->invite_only){echo "Yes";}else{echo "No" ;}?></td>
			<td><?= h($this->Number->currency($competition->entry_fee,"GBP")); ?>&nbsp;</td>
			<td><?= h($this->Number->toPercentage($competition->prize_percent)); ?>&nbsp;</td>
			<td><?= h($this->Time->format($competition->closing_entry_date,	"MMM dd yyyy")); ?>&nbsp;</td>
			<td><?= h($this->Time->format($competition->finish_date, "MMM dd yyyy")); ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('Punt'), ['controller' => 'entries', 'action' => 'add', $competition->id]); ?>
			<?= $this->Html->link(__('Leader Board'), ['controller' => 'entries', 'action' => 'leaderBoard', $competition->id]); ?>
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
		<?php else:?>
	There are no competions for this tournament yet.
    </div>
	<?php endif; ?>
	</div>
	<div class="actions">
		<ul>
			<li><?= $this->Html->link(__('Organise a Competition'), ['controller' => 'competitions', 'action' => 'add']); ?> </li>
			<li><?= $this->Html->link(__('Fixtures'), ['controller' => 'fixtures', 'action' => 'byTournament', $tournament->id]); ?> </li>
		</ul>
	</div>
</div>
