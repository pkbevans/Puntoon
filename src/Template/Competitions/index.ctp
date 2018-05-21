<!-- NORMAL VERSION -->
<?php use Cake\I18n\Time;?>
<div class="competitions index large-9 medium-8 columns content">
    <h3><?= __('Competitions') ?></h3>
    <table class="filter">
	<tr>
			<td><?php 
			echo $this->Form->create('filter', ['type' => 'get', 'url' => ['action' => 'index']]);?>
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
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('tournament_id') ?></th>
                <th><?= $this->Paginator->sort('organiser_id') ?></th>
                <th><?= $this->Paginator->sort('invite_only', 'Invitation Only') ?></th>
                <th><?= $this->Paginator->sort('entry_fee') ?></th>
                <th><?= $this->Paginator->sort('prize_percent') ?></th>
				<th><?= $this->Paginator->sort('closing_entry_date'); ?></th>
				<th><?= $this->Paginator->sort('finish_date'); ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
	<?php foreach ($competitions as $competition): ?>
	<tr>
		<td><?= h($competition->name); ?>&nbsp;</td>
		<td><?= $this->Html->link($competition->tournament->name, ['controller' => 'tournaments', 'action' => 'view', $competition->tournament->id]); ?></td>
		<td><?= $this->Html->link($competition->organiser->username, ['controller' => 'users', 'action' => 'view', $competition->organiser->id]); ?></td>
		<td><?php if($competition->invite_only){echo "Yes";}else{echo "No" ;}?></td>
		<td><?= h($this->Number->currency($competition->entry_fee,"GBP")); ?>&nbsp;</td>
		<td><?= h($this->Number->toPercentage($competition->prize_percent)); ?>&nbsp;</td>
		<td><?= h($this->Time->format($competition->closing_entry_date,	"MMM dd yyyy")); ?>&nbsp;</td>
		<td><?= h($this->Time->format($competition->finish_date, "MMM dd yyyy")); ?>&nbsp;</td>
		<td class="actions">
			<?php 
// 				$today
				if(Time::now()<=new Time($competition->closing_entry_date)):?>
			<?= $this->Html->link(__('Punt'), ['controller' => 'entries', 'action' => 'add', $competition->id, $competition->tournament_id]); ?>
			<?php endif;?>
			<?= $this->Html->link(__('Leader Board'), ['controller' => 'entries', 'action' => 'leaderBoard', $competition->id]); ?>
		</td>
	</tr>
<?php endforeach; ?>
                </tbody>
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
