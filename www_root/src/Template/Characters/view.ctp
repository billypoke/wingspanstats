<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Character'), ['action' => 'edit', $character->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Character'), ['action' => 'delete', $character->id], ['confirm' => __('Are you sure you want to delete # {0}?', $character->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Characters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Agents'), ['controller' => 'Agents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Agent'), ['controller' => 'Agents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Kills'), ['controller' => 'Kills', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kill'), ['controller' => 'Kills', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Victims'), ['controller' => 'Victims', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Victim'), ['controller' => 'Victims', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="characters view large-9 medium-8 columns content">
    <h3><?= h($character->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Character Name') ?></th>
            <td><?= h($character->character_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($character->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Character Id') ?></th>
            <td><?= $this->Number->format($character->character_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Characters') ?></h4>
        <?php if (!empty($character->characters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Character Name') ?></th>
                <th scope="col"><?= __('Character Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($character->characters as $characters): ?>
            <tr>
                <td><?= h($characters->id) ?></td>
                <td><?= h($characters->character_name) ?></td>
                <td><?= h($characters->character_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Characters', 'action' => 'view', $characters->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Characters', 'action' => 'edit', $characters->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Characters', 'action' => 'delete', $characters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characters->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Agents') ?></h4>
        <?php if (!empty($character->agents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Character Id') ?></th>
                <th scope="col"><?= __('Ships Destroyed') ?></th>
                <th scope="col"><?= __('Isk Destroyed') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($character->agents as $agents): ?>
            <tr>
                <td><?= h($agents->id) ?></td>
                <td><?= h($agents->character_id) ?></td>
                <td><?= h($agents->ships_destroyed) ?></td>
                <td><?= h($agents->isk_destroyed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Agents', 'action' => 'view', $agents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Agents', 'action' => 'edit', $agents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Agents', 'action' => 'delete', $agents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $agents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Kills') ?></h4>
        <?php if (!empty($character->kills)): ?>
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
            <?php foreach ($character->kills as $kills): ?>
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
        <h4><?= __('Related Victims') ?></h4>
        <?php if (!empty($character->victims)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Character Id') ?></th>
                <th scope="col"><?= __('Ships Lost') ?></th>
                <th scope="col"><?= __('Isk Lost') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($character->victims as $victims): ?>
            <tr>
                <td><?= h($victims->id) ?></td>
                <td><?= h($victims->character_id) ?></td>
                <td><?= h($victims->ships_lost) ?></td>
                <td><?= h($victims->isk_lost) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Victims', 'action' => 'view', $victims->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Victims', 'action' => 'edit', $victims->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Victims', 'action' => 'delete', $victims->id], ['confirm' => __('Are you sure you want to delete # {0}?', $victims->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
