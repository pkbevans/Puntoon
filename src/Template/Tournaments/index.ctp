<div class="tournaments index large-9 medium-8 columns content">
    <h3><?= __('Tournamex   nts') ?></h3>
	<table class="filter">
	<tr>
			<td><?php 
			echo $this->Form->create('filter', ['type' => 'get', 'url' => ['action' => 'index']]);?>
			&nbsp;Show all Tournaments&nbsp;
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
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finish_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tournaments as $tournament): ?>
            <tr>
                <td><?= $this->Html->link(__($tournament->name), ['action' => 'edit', $tournament->id]); ?></td>
				<td><?= h($this->Time->format($tournament->start_date, "MMM dd yyyy")); ?>&nbsp;</td>
				<td><?= h($this->Time->format($tournament->finish_date, "MMM dd yyyy")); ?>&nbsp;</td>
				<td class="actions">
					<?= $this->Html->link(__('Results'), ['controller'=>'fixtures', 'action' => 'results', $tournament->id]); ?>
					<?= $this->Html->link(__('Delete Fixtures'), ['controller'=>'fixtures', 'action' => 'delete_all', $tournament->id]); ?>
					<?= $this->Html->link(__('Reset Entries'), ['controller'=>'entries', 'action' => 'reset_all', $tournament->id]); ?>
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
