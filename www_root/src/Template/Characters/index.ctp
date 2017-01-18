<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Character'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Agents'), ['controller' => 'Agents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Agent'), ['controller' => 'Agents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Kills'), ['controller' => 'Kills', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Kill'), ['controller' => 'Kills', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Victims'), ['controller' => 'Victims', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Victim'), ['controller' => 'Victims', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characters index large-9 medium-8 columns content">
    <h3><?= __('Characters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('character_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('character_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characters as $character): ?>
            <tr>
                <td><?= $this->Number->format($character->id) ?></td>
                <td><?= h($character->character_name) ?></td>
                <td><?= $this->Number->format($character->character_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $character->character_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $character->character_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $character->id], ['confirm' => __('Are you sure you want to delete # {0}?', $character->character_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
