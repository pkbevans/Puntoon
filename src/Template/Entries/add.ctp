<div class="entries form">
<?= $this->Form->create('Entry'); ?>
	<fieldset>
		<legend><?= __('Take a punt on: '. $competition->name ); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('team_1_id');
		echo $this->Form->input('team_2_id');
		echo $this->Form->input('team_3_id');
		echo $this->Form->input('team_4_id');
		echo $this->Form->input('team_5_id');
	?>
	</fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end(); ?>
</div>
