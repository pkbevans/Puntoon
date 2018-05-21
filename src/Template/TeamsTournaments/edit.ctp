<div class="teamsTournaments form large-9 medium-8 columns content">
    <?= $this->Form->create($teamsTournament) ?>
    <fieldset>
        <legend><?= __('Edit Teams Tournament') ?></legend>
        <?php
            echo $this->Form->input('tournament_id', ['options' => $tournaments]);
            echo $this->Form->input('team_id', ['options' => $teams]);
            echo $this->Form->input('goals');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
