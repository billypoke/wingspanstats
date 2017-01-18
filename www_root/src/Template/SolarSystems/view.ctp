<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Solar System'), ['action' => 'edit', $solarSystem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Solar System'), ['action' => 'delete', $solarSystem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solarSystem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Solar Systems'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solar System'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Kills'), ['controller' => 'Kills', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Kill'), ['controller' => 'Kills', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="solarSystems view large-9 medium-8 columns content">
    <h3><?= h($solarSystem->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($solarSystem->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($solarSystem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Solar System Id') ?></th>
            <td><?= $this->Number->format($solarSystem->solar_system_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Kills') ?></h4>
        <?php if (!empty($solarSystem->kills)): ?>
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
            <?php foreach ($solarSystem->kills as $kills): ?>
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
</div>
