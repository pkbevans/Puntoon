<div class="teamsTournaments index large-9 medium-8 columns content">
    <h3><?= __('Teams Tournaments') ?></h3>
    <table>
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tournament_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('team_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('goals') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teamsTournaments as $teamsTournament): ?>
            <tr>
                <td><?= $this->Number->format($teamsTournament->id) ?></td>
                <td><?= $teamsTournament->has('tournament') ? $this->Html->link($teamsTournament->tournament->name, ['controller' => 'Tournaments', 'action' => 'view', $teamsTournament->tournament->id]) : '' ?></td>
                <td><?= $teamsTournament->has('team') ? $this->Html->link($teamsTournament->team->name, ['controller' => 'Teams', 'action' => 'view', $teamsTournament->team->id]) : '' ?></td>
                <td><?= $this->Number->format($teamsTournament->goals) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $teamsTournament->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $teamsTournament->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $teamsTournament->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamsTournament->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
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
