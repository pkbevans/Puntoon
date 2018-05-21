<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fixture'), ['action' => 'edit', $fixture->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fixture'), ['action' => 'delete', $fixture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fixture->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fixtures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fixture'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tournaments'), ['controller' => 'Tournaments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tournament'), ['controller' => 'Tournaments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Team As'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team A'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fixtures view large-9 medium-8 columns content">
    <h3><?= h($fixture->description) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tournament') ?></th>
            <td><?= $fixture->has('tournament') ? $this->Html->link($fixture->tournament->name, ['controller' => 'Tournaments', 'action' => 'view', $fixture->tournament->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($fixture->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Team A') ?></th>
            <td><?= $fixture->has('team_a') ? $this->Html->link($fixture->team_a->name, ['controller' => 'Teams', 'action' => 'view', $fixture->team_a->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Team B') ?></th>
            <td><?= $fixture->has('team_b') ? $this->Html->link($fixture->team_b->name, ['controller' => 'Teams', 'action' => 'view', $fixture->team_b->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $fixture->has('status') ? $this->Html->link($fixture->status->name, ['controller' => 'Statuses', 'action' => 'view', $fixture->status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fixture->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Team A Score') ?></th>
            <td><?= $this->Number->format($fixture->team_a_score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Team B Score') ?></th>
            <td><?= $this->Number->format($fixture->team_b_score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($fixture->date) ?></td>
        </tr>
    </table>
</div>
