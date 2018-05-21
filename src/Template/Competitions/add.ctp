<div class="competitions form large-9 medium-8 columns content">
    <?= $this->Form->create($competition) ?>
    <fieldset>
        <legend><?= __('Add Competition') ?></legend>
        <?php
            echo $this->Form->input('tournament_id');
            echo $this->Form->input('name');
            echo $this->Form->input('invite_only');
            echo $this->Form->input('entry_fee');
            echo $this->Form->input('prize_percent');
            echo $this->Form->input('closing_entry_date');
            echo $this->Form->input('finish_date');
            ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
