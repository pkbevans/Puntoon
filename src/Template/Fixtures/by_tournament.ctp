<div class="fixtures index">
	<h2><?= __($tournament->name. ' - Fixtures'); ?></h2>
	<table class="filter">
	<tr>
			<td><?php 
			echo $this->Form->create('filter', ['type' => 'get', 'url' => ['action' => 'by_tournament',$tournament->id]]);?>
			&nbsp;Show all fixtures&nbsp;
			<?php 
				if(empty ($showAll)){
					echo $this->Form->checkbox('showAll', ['selected'=>'false']);
				}else{
					echo $this->Form->checkbox('showAll', ['checked'=>'true']);
				}
			?>
			</td>
			<td><?= $this->Form->button(__('Filter'));
				$this->Form->end(); ?></td>
		</tr>
	</table>
	
	<table class="fixtures">
	<?php 
		$prevDate='';
		foreach ($fixtures as $fixture): 
		if($prevDate!=$this->Time->format($fixture->date, 'YYYYMMdd')){
			echo "<tr>".
			"<td colspan=\"5\" class=\"fixture_date\">". 
			$this->Time->format($fixture->date,	"EEEE, MMM dd yyyy").
			"</td>".
			"<td class=\"fixture_time\"></td>".
			"<td class=\"fixture_action\"></td>".
			"</tr>";
			$prevDate=$this->Time->format($fixture->date, 'YYYYMMdd');
		}
	?>
	<tr>
		<td class="home_team"><?= $fixture->team_a->name;?></td>
		<?php if($fixture->status->id != 0):?>
		<td class="home_team_score"><?= $fixture->team_a_score;?></td>
  		<td class="vs">-</td>
		<td class="away_team_score"><?= $fixture->team_b_score;?></td>
		<?php else:?>
		<td class="home_team_score">&nbsp;</td>
  		<td class="vs">vs</td>
		<td class="away_team_score">&nbsp;</td>
		<?php endif;?>
		<td class="away_team"><?= $fixture->team_b->name;?></td>
		<td class="fixture_time"><?= $this->Time->format($fixture->date, 'HH:mm');?></td>
		<td class="fixture_action">
			<?= $this->Html->link(__('Edit'), ['action' => 'editResult', $fixture->id, $this->Paginator->current(), empty($showAll)?0:$showAll]); ?>
		</td>
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
