<?php

$this->extend('_escolas_tabs_infra');

?>

<?= $this->Form->create() ?>

<div class="box box-danger">
    <?= $this->Box->header([
        'icon' => 'excluir',
        'text' => 'Exclusão de Sala de Aula',
    ]) ?>
    <div class="box-body">
        <p>
            Você deseja excluir a sala de aula "<strong><?= $escolaSala->nome ?></strong>"
            do local <?= $escolaSala->escola_local->nome ?>?
        </p>
    </div>
    <div class="box-footer">
        <?= $this->Form->submit('Excluir a Sala de Aula', [
            'style' => 'danger'
        ]) ?>
        
        <?= $this->Button->render([
            'text' => 'Cancelar',
            'icon' => 'cancelar',
            'url' => [
                'action' => 'infraSalasListar',
                h($escola->id),
            ]
        ]) ?>
    </div>
</div>

<?= $this->Form->end() ?>
