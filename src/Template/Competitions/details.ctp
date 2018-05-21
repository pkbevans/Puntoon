<?php use Cake\I18n\Time;?>
<div class="competitions view">
<h2><?= __('Competition'); ?></h2>
	<dl>
		<dt><?= __('Tournament'); ?></dt>
		<dd><?= $this->Html->link($competition->tournament->name, ['controller' => 'tournaments', 'action' => 'view', $competition->tournament->id]); ?>&nbsp;</dd>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($competition->name); ?>&nbsp;</dd>
		<dt><?= __('Organiser'); ?></dt>
		<dd><?= $this->Html->link($competition->organiser->username, ['controller' => 'users', 'action' => 'view', $competition->organiser_id]); ?>&nbsp;</dd>
		<dt><?= __('Invitation Only'); ?></dt>
		<dd><?php if($competition->invite_only){echo "Yes";}else{echo "No" ;} ?>&nbsp;</dd>
		<dt><?= __('Closing Entry Date'); ?></dt>
		<dd><?= h($this->Time->format($competition->closing_entry_date, "MMM dd yyyy")); ?>&nbsp;</dd>
		<dt><?= __('Finish Date'); ?></dt>
		<dd><?= h($this->Time->format($competition->finish_date, "MMM dd yyyy")); ?>&nbsp;</dd>
		
	</dl>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<?= $this->Html->link(__('Leader Board'), ['controller' => 'entries', 'action' => 'leaderBoard', $competition->id]); ?> 
	</ul>
</div>
