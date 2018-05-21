<div class="tournaments form large-9 medium-8 columns content">
    <?= $this->Form->create($tournament) ?>
    <fieldset>
        <legend><?= __('Add Tournament') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('teams._ids', ['options' => $teams]);
            echo $this->Form->input('start_date');
            echo $this->Form->input('finish_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
