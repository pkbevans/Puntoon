<div class="teams_tournaments index">
	<h2><?= __($tournament->name. ' - Teams'); ?></h2>
	<table>
	<tr>
			<th><?= $this->Paginator->sort('name'); ?></th>
	</tr>
	<?php foreach ($teamsTournaments as $teamsTournament): ?>
	<tr>
		<td><?= $this->Html->link($teamsTournament->team->name,['action' => 'view', $teamsTournament->team->id]); ?>&nbsp;</td>
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
