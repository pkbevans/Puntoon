<div class="fixtures">
	<h2><?= __('Edit Results'); ?></h2>
	<table class="fixtures">
	<tr>
			<td><?php 
			echo $this->Form->create('filter', ['type' => 'get', 'url' => ['action' => 'results']]);?>
			&nbsp;Show ALL fixtures&nbsp;
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
	<thead>
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
	</thead>
	<tr>
	
		<td class="home_team"><a href="<?= $this->Url->build(["action" => "editResult",$fixture->id, $this->Paginator->current(), empty($showAll)?0:$showAll]); ?>"><?= $fixture->team_a->name;?></a></td>
		<?php if($fixture->status->id != 0):?>
		<td class="home_team_score"><a href="<?= $this->Url->build(["action" => "editResult",$fixture->id, $this->Paginator->current(), empty($showAll)?0:$showAll]); ?>"><?= $fixture->team_a_score;?></a></td>
  		<td class="vs"><a href="<?= $this->Url->build(["action" => "editResult",$fixture->id, $this->Paginator->current(), empty($showAll)?0:$showAll]); ?>">-</a></td>
		<td class="away_team_score"><a href="<?= $this->Url->build(["action" => "editResult",$fixture->id, $this->Paginator->current(), empty($showAll)?0:$showAll]); ?>"><?= $fixture->team_b_score;?></a></td>
		<?php else:?>
		<td class="home_team_score"><a href="<?= $this->Url->build(["action" => "editResult",$fixture->id, $this->Paginator->current(), empty($showAll)?0:$showAll]); ?>">&nbsp;</a></td>
  		<td class="vs"><a href="<?= $this->Url->build(["action" => "editResult",$fixture->id, $this->Paginator->current(), empty($showAll)?0:$showAll]); ?>">vs</a></td>
		<td class="away_team_score"><a href="<?= $this->Url->build(["action" => "editResult",$fixture->id, $this->Paginator->current(), empty($showAll)?0:$showAll]); ?>">&nbsp;</a></td>
		<?php endif;?>
		<td class="away_team"><a href="<?= $this->Url->build(["action" => "editResult",$fixture->id, $this->Paginator->current(), empty($showAll)?0:$showAll]); ?>"><?= $fixture->team_b->name;?></a></td>
		<td class="fixture_time"><?= $this->Time->format($fixture->date, 'HH:mm');?></td>
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

