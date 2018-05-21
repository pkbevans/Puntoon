<div class="users index">
	<h2><?= __('Users'); ?></h2>
	<table>
	<tr>
			<th><?= $this->Paginator->sort('id'); ?></th>
			<th><?= $this->Paginator->sort('username'); ?></th>
			<th><?= $this->Paginator->sort('role'); ?></th>
        	<th><?= $this->Paginator->sort('firstname') ?></th>
        	<th><?= $this->Paginator->sort('surname') ?></th>
			</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?= h($user->id); ?>&nbsp;</td>
		<td><?= $this->Html->link($user->username, ['action' => 'view', $user->id]); ?></td>
		<td><?= h($user->role); ?>&nbsp;</td>
        <td><?= h($user->firstname) ?></td>
        <td><?= h($user->surname) ?></td>
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
