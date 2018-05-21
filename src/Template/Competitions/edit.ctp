<div class="competitions form large-9 medium-8 columns content">
    <?= $this->Form->create($competition);
    $this->Form->templates([
    		'dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}'
    		]);
    ?>
    <fieldset>
        <legend><?= __('Edit Competition') ?></legend>
        	<?= $this->Form->input('tournament_id');?>
        	<?= $this->Form->input('name');?>
            <?= $this->Form->input('invite_only');?>
            <?= $this->Form->input('prize_percent');?>
            <?= $this->Form->input('entry_fee');?>
            <?= $this->Form->input('closing_entry_date');?>
			<?= $this->Form->input('finish_date');?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>
