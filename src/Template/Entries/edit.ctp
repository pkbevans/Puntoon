<div class="entries form">
<?= $this->Form->create($entry); ?>
	<fieldset>
		<legend><?= __('Edit Entry for: '. $entry->user->username); ?></legend>
	<?= $this->Form->input('competition_id'); ?>
	<?= $this->Form->input('name'); ?>
	<?= $this->Form->input('team_1_id'); ?>
	<?= $this->Form->input('team_2_id'); ?>
	<?= $this->Form->input('team_3_id'); ?>
	<?= $this->Form->input('team_4_id'); ?>
	<?= $this->Form->input('team_5_id'); ?>
<!--<?= $this->Form->input('status_id'); ?>-->	
	</fieldset>
	<?= $this->Form->button(__('Save')); ?>
	<?= $this->Form->end(); ?>
</div>
