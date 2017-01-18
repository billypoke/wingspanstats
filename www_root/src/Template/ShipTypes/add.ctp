<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Ship Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Kills'), ['controller' => 'Kills', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Kill'), ['controller' => 'Kills', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ships'), ['controller' => 'Ships', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ship'), ['controller' => 'Ships', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="shipTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($shipType) ?>
    <fieldset>
        <legend><?= __('Add Ship Type') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('ship_type_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
