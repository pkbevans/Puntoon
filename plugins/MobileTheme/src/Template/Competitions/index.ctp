<!-- MOBILE VERSION -->
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
			</td>
			<td><?= $this->Form->button(__('Filter'));
				$this->Form->end(); ?></td>
		</tr>
	</table>
    
    <table>
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
	<?php foreach ($competitions as $competition): ?>
	<tr>
		<td><?= $this->Html->link(__($competition->name), ['action' => 'details', $competition->id]); ?>&nbsp;</td>
		<td class="actions">
			<?php if(Time::now()<=new Time($competition->closing_entry_date)):?>
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
