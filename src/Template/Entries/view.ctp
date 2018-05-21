<div class="entries view">
<h2><?php echo __('Entry'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($entry->id); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Competition Id'); ?></dt>
		<dd>
			<?php echo h($entry->competition_id); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entry->user->username, ['controller' => 'users', 'action' => 'view', $entry->user->id]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($entry->name); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team1'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entry->team1->name, ['controller' => 'teams-tournaments', 'action' => 'view', $entry->tournament_id, $entry->team1->id]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team2'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entry->team2->name, ['controller' => 'teams-tournaments', 'action' => 'view', $entry->tournament_id, $entry->team2->id]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team3'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entry->team3->name, ['controller' => 'teams-tournaments', 'action' => 'view', $entry->tournament_id, $entry->team3->id]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team4'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entry->team4->name, ['controller' => 'teams-tournaments', 'action' => 'view', $entry->tournament_id, $entry->team4->id]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team5'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entry->team5->name, ['controller' => 'teams-tournaments', 'action' => 'view', $entry->tournament_id, $entry->team5->id]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status Id'); ?></dt>
		<dd>
			<?php echo h($entry->status->name); ?>
			&nbsp;
		</dd>
	</dl>
</div>
