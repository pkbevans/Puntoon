<div class="fixtures form large-9 medium-8 columns content">
    <?= $this->Form->create($fixture) ?>
    <fieldset>
        <legend><?= __('Edit Fixture: '. $teamA->name . " vs ". $teamB->name) ?></legend>
        <?php
            echo $this->Form->input('tournament_id', ['options' => $tournaments]);
            echo $this->Form->input('description');
            echo $this->Form->input('date');
            echo $this->Form->input('status_id', ['options' => $statuses]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
