<div class="users form">
<?= $this->Form->create('User'); ?>
	<fieldset>
		<legend><?= __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
        echo $this->Form->input('firstname');
        echo $this->Form->input('surname');
	?>
	</fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>

		<li><?= $this->Html->link(__('List Users'), ['action' => 'index']); ?></li>
	</ul>
</div>
