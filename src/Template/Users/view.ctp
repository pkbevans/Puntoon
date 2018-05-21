<div class="users view">
    <h3><?= h("Username: ". $user->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Firstname') ?></th>
            <td><?= h($user->firstname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname') ?></th>
            <td><?= h($user->surname) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Punts') ?></h4>
        <?php if (!empty($entries)): ?>
        <table>
            <tr>
                <th scope="col"><?= __('Competition') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Team 1') ?></th>
                <th scope="col"><?= __('Team 2') ?></th>
                <th scope="col"><?= __('Team 3') ?></th>
                <th scope="col"><?= __('Team 4') ?></th>
                <th scope="col"><?= __('Team 5') ?></th>
<!--            <th scope="col"><?= __('Status') ?></th>-->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= h($entry->competition->name) ?></td>
                <td><?= h($entry->name) ?></td>
                <td><?= h($entry->team1->name) ?></td>
                <td><?= h($entry->team2->name) ?></td>
                <td><?= h($entry->team3->name) ?></td>
                <td><?= h($entry->team4->name) ?></td>
                <td><?= h($entry->team5->name) ?></td>
<!--  			<td><?= h($entry->status->name) ?></td>-->
				<td class="actions">
					<?= $this->Html->link(__('Leader Board'), ['controller' => 'entries', 'action' => 'leader-board', $entry->competition->id]); ?>
				</td>
                
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
