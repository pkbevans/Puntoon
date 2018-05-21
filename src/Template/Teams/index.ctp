<div class="teams index">
	<h2><?= __('Teams'); ?></h2>
	<table>
	<tr>
			<th><?= $this->Paginator->sort('id'); ?></th>
			<th><?= $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?= __('Actions'); ?></th>
	</tr>
	<?php foreach ($teams as $team): ?>
	<tr>
		<td><?= h($team->id); ?>&nbsp;</td>
		<td><?= h($team->name); ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('View'), array('action' => 'view', $team->id)); ?>
			<?= $this->Form->postLink(__('Delete'), array('action' => 'delete', $team->id), [], __('Are you sure you want to delete # {0}?', $team->id)); ?>
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
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('New Team'), array('action' => 'add')); ?></li>
	</ul>
</div>
