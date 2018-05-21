<?php use Cake\I18n\Time;?>
<div class="competitions view">
<h2><?= __('Competition: '.$competition->name. " (". $competition->organiser->username.")"); ?></h2>
	<table>
		<tr>
			<td><?= __('Tournament'); ?></td>
			<td><?= $this->Html->link($competition->tournament->name, ['controller' => 'tournaments', 'action' => 'view', $competition->tournament->id]); ?>&nbsp;</td>
			<td><?= __('Invitation Only'); ?></td>
			<td><?php if($competition->invite_only){echo "Yes";}else{echo "No" ;} ?>&nbsp;</td>
		</tr>
		<tr>
			<td><?= __('Closing Entry Date'); ?></td>
			<td><?= h($this->Time->format($competition->closing_entry_date, "MMM dd yyyy")); ?>&nbsp;</td>
			<td><?= __('Finish Date'); ?></td>
			<td><?= h($this->Time->format($competition->finish_date, "MMM dd yyyy")); ?>&nbsp;</td>
		</tr>
		<tr>
			<td><?= __('Entry Fee'); ?></td>
			<td><?= h($this->Number->currency($competition->entry_fee,"GBP")); ?>&nbsp;</td>
			<td><?= __('Prize Percent'); ?></td>
			<td><?= h($this->Number->toPercentage($competition->prize_percent)); ?>&nbsp;</td>
		</tr>
		<tr>
			<td><?= __('Prize Fund'); ?></td>
			<td><?= h($this->Number->currency($competition->prize_fund,"GBP")); ?>&nbsp;</td>
			<td><?= __('Paid/Unpaid'); ?></td>
			<td><?= h($competition->paid_entries."/".$competition->num_entries); ?>&nbsp;</td>
			</tr>
		<tr>	
	</table>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<?= $this->Html->link(__('Leader Board'), ['controller' => 'entries', 'action' => 'leaderBoard', $competition->id]); ?> 
	</ul>
</div>
<div class="related">
	<h3><?= __('Entries'); ?></h3>
	<?php if (!empty($entries)): ?>
	<table>
	<tr>
		<th><?= $this->Paginator->sort('User'); ?></th>
		<th><?= $this->Paginator->sort('Name'); ?></th>
		<th><?= $this->Paginator->sort('Team 1'); ?></th>
		<th><?= $this->Paginator->sort('Team 2'); ?></th>
		<th><?= $this->Paginator->sort('Team 3'); ?></th>
		<th><?= $this->Paginator->sort('Team 4'); ?></th>
		<th><?= $this->Paginator->sort('Team 5'); ?></th>
		<th><?= $this->Paginator->sort('Paid'); ?></th>
		<th class="actions"><?= __('Actions'); ?></th>	
	</tr>
	<?php foreach ($entries as $entry): ?>
		<tr>
			<td><?= $entry->user->username; ?></td>
			<td><?= $entry->name; ?> 
			<td><?= $entry->team1->name; ?></td>
			<td><?= $entry->team2->name; ?></td>
			<td><?= $entry->team3->name; ?></td>
			<td><?= $entry->team4->name; ?></td>
			<td><?= $entry->team5->name; ?></td>
			<td><?php 
			echo $this->Form->create('update', ['type' => 'post', 'url' => ['controller'=>'entries', 'action' => 'updatePaid', $entry->id]]);
						
			if($entry->paid){
				echo $this->Form->checkbox('paid', ['checked'=>'true']);
			}else {
				echo $this->Form->checkbox('paid', ['selected'=>'false']);
			}
			?></td>
			<td class="actions">
				<?= $this->Form->button(__('Update'));$this->Form->end();?>
				<?= $this->Html->link(__('Chase'), ['controller'=>'entries', 'action' => 'chase_payment', $entry->id]); ?>
				<?= $this->Html->link(__('Edit'), ['controller'=>'entries', 'action' => 'edit', $entry->id]); ?>
				<?= $this->Html->link(__('Delete'), ['controller' => 'entries', 'action' => 'delete', $entry->id],  
						['confirm' => __('Are you sure you want to delete: {0}?', $entry->name)]);?>
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
        <?php else:  ?>
        No entries yet
        <?php endif;?>
    </div>
		<div class="actions">
		<ul>
			<li><?= $this->Html->link(__('Add Entry'), ['controller' => 'entries', 'action' => 'addEntry',$competition->id, $competition->tournament_id, "VIEW"]); ?> </li>
			<?php if(Time::now()<=new Time($competition->closing_entry_date)):?>
			<li>Competition Closed</li>
			<?php endif;?>
		</ul>
	</div>
</div>
