<?php use Cake\I18n\Time;?>
<div>
    <h3><?= __('Auto Update Fixtures from api.football-data.org (426)') ?></h3>
    <table class="fixtures">
		<tr>
			<td><?php 
			echo $this->Form->create('filter', ['type' => 'post']);?>
			&nbsp;Future&nbsp;
			<?php 
				if(empty ($future)){
						echo $this->Form->checkbox('future', ['selected'=>'false']);
				}else{
					echo $this->Form->checkbox('future', ['checked'=>'true']);
				}
			?>
			</td>
			<td><?= $this->Form->input('comp', ['label' => "League"]);?>&nbsp;</td>
			<td><?= $this->Form->input('days', ['label' => "Days"]);?>&nbsp;</td>
			<td><?= $this->Form->button(__('Get Updates'));?></td>
			<?= $this->Form->end();?>
		</tr>
	</table>
    
    <table class="fixtures">
	<thead>
		<tr>
			<th>Date</th>
			<th>Home Team</th>
			<th></th>
			<th></th>
			<th>Away Team</th>
			<th>Time</th>
			<th>Action</th>
		</tr>
	</thead>
	<?php if(isset($fixtures)):?>
	<?php foreach ($fixtures as $fixture): 	?>
	<?php //debug($fixture['date']);
		Time::setDefaultLocale('en-GB');
		$fixDate = Time::parse($fixture['date']);?>

	<tr>
		<td><?= $fixDate->format("Y-m-d"); ?></td>
		<td><?= $fixture['homeTeamName'];?></td>
		<td><?= $fixture['result']['goalsHomeTeam'];?></td>
		<td><?= $fixture['result']['goalsAwayTeam'];?></td>
		<td><?= $fixture['awayTeamName'];?></td>
		<td><?= $fixDate->format('H:i');?></td>
		<td><?= $fixture['action'];?></td>
		</tr>
	<?php endforeach; ?>
	<?php endif;?>
	</table>    
</div>
