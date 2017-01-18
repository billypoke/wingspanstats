<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ship Type'), ['action' => 'edit', $shipType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ship Type'), ['action' => 'delete', $shipType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shipType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ship Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ship Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Kills'), ['controller' => 'Kills', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kill'), ['controller' => 'Kills', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ships'), ['controller' => 'Ships', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ship'), ['controller' => 'Ships', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="shipTypes view large-9 medium-8 columns content">
    <h3><?= h($shipType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($shipType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($shipType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ship Type Id') ?></th>
            <td><?= $this->Number->format($shipType->ship_type_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Kills') ?></h4>
        <?php if (!empty($shipType->kills)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Character Id') ?></th>
                <th scope="col"><?= __('Ship Type Id') ?></th>
                <th scope="col"><?= __('Solar System Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Kill Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($shipType->kills as $kills): ?>
            <tr>
                <td><?= h($kills->id) ?></td>
                <td><?= h($kills->character_id) ?></td>
                <td><?= h($kills->ship_type_id) ?></td>
                <td><?= h($kills->solar_system_id) ?></td>
                <td><?= h($kills->date) ?></td>
                <td><?= h($kills->value) ?></td>
                <td><?= h($kills->kill_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Kills', 'action' => 'view', $kills->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Kills', 'action' => 'edit', $kills->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Kills', 'action' => 'delete', $kills->id], ['confirm' => __('Are you sure you want to delete # {0}?', $kills->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Ships') ?></h4>
        <?php if (!empty($shipType->ships)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Ship Type Id') ?></th>
                <th scope="col"><?= __('Ships Destroyed') ?></th>
                <th scope="col"><?= __('Isk Destroyed') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($shipType->ships as $ships): ?>
            <tr>
                <td><?= h($ships->id) ?></td>
                <td><?= h($ships->ship_type_id) ?></td>
                <td><?= h($ships->ships_destroyed) ?></td>
                <td><?= h($ships->isk_destroyed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ships', 'action' => 'view', $ships->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ships', 'action' => 'edit', $ships->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ships', 'action' => 'delete', $ships->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ships->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
