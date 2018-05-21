<div class="fixtures form">
<?= $this->Form->create($fixture); ?>
	<fieldset>
		<legend><?= __($tournament->name. " - ". $this->Time->format($fixture->date, 'dd MMM YYYY')); ?></legend><br>
	<table>
		<tr>
		<td><?= $this->Form->input('team_a_score', ['label' => $teamA->name,'autofocus']);?>&nbsp;</td>
		<td><?= $this->Form->input('team_b_score', ['label' => $teamB->name]);?>&nbsp;</td>
		<td><?= $this->Form->input('status_id', ['options' => $statuses]);?>&nbsp;</td>
	</tr>
	</table>
	</fieldset>
	<?= $this->Form->button('Update');?>
	<?= $this->Form->end(); ?>
</div>
