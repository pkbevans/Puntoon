<div class="fixtures form large-9 medium-8 columns content">
    <?= $this->Form->create($fixture) ?>
    <fieldset>
        <legend><?= __('Add a Fixture') ?></legend>
        <?php
            echo $this->Form->input('tournament_id', ['options' => $tournaments]);
            echo $this->Form->input('description');
            echo $this->Form->input('date');
            echo $this->Form->input('team_a_id', ['options' => $teamAs]);
            echo $this->Form->input('team_a_score');
            echo $this->Form->input('team_b_score');
            echo $this->Form->input('team_b_id', ['options' => $teamBs]);
            echo $this->Form->input('status_id', ['options' => $statuses]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
