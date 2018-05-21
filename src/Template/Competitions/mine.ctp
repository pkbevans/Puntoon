<div class="competitions index">
	<h2><?= __('Competitions organized by: '. $user->firstname." " . $user->surname); ?></h2>
	<?php if($competitions):?>
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
			<?= $this->Form->button(__('Refresh'));
				$this->Form->end(); ?></td>
		</tr>
	</table>
	
	<table>
	<tr>
			<th><?= $this->Paginator->sort('name'); ?></th>
			<th><?= $this->Paginator->sort('tournament_id'); ?></th>
			<th><?= $this->Paginator->sort('invite_only','Invitation Only'); ?></th>
            <th><?= $this->Paginator->sort('entry_fee') ?></th>
			<th><?= $this->Paginator->sort('prize_percent'); ?></th>
			<th><?= $this->Paginator->sort('closing_entry_date'); ?></th>
			<th><?= $this->Paginator->sort('finish_date'); ?></th>
			<th class="actions"><?= __('Actions'); ?></th>
	</tr>
	<?php foreach ($competitions as $competition): ?>
	<tr>
		<td><?= $this->Html->link($competition->name,array('action' => 'view', $competition->id)); ?>&nbsp;</td>
		<td><?= $this->Html->link($competition->tournament->name, array('controller' => 'tournaments', 'action' => 'view', $competition->tournament->id)); ?></td>
		<td><?php if($competition->invite_only){echo "Yes";}else{echo "No" ;}?></td>
		<td><?= h($this->Number->currency($competition->entry_fee,"GBP")); ?>&nbsp;</td>
		<td><?= h($this->Number->toPercentage($competition->prize_percent)); ?>&nbsp;</td>
		<td><?= h($this->Time->format($competition->closing_entry_date,	"MMM dd yyyy")); ?>&nbsp;</td>
		<td><?= h($this->Time->format($competition->finish_date, "MMM dd yyyy")); ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('Edit'), ['action' => 'edit', $competition->id]); ?>
			<?= $this->Html->link(__('Leader Board'), ['controller' => 'leaders', 'action' => 'leaderBoard', $competition->id]); ?>
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
	<h3>No competitions</h3>
	<?php endif;?>
	</div>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Organise a Competition'), ['action' => 'add']); ?></li>
	</ul>
</div>
