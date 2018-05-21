<div class="teams index">
	<h2><?= __($tournament->name. ' - Teams'); ?></h2>
	<table>
	<tr>
			<th><?= $this->Paginator->sort('name'); ?></th>
			<th><?= $this->Paginator->sort('goals'); ?></th>
	</tr>
	<?php foreach ($teams as $team): ?>
	<tr>
		<td><?= $this->Html->link(($team->name), ['action' => 'view', $team->id]); ?></td>
		<td><?= h($team->goals); ?>&nbsp;</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter([
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	]);
	?>	</p>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
	</div>
