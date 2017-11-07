<?php

$this->extend('_escolas_tabs_infra');

// debug($escolaLocalCompartilhamento);

?>

<?= $this->Form->create() ?>

<div class="box box-danger">
    <?= $this->Box->header([
        'icon' => 'excluir',
        'text' => 'Exclusão de Compartilhamento de  Local de Funcionamento',
    ]) ?>
    <div class="box-body">
        <p>
            Você deseja excluir o compartilhamento do local
            <strong><?= $escolaLocalCompartilhamento->escola_local->nome ?></strong>
            com <strong><?= $escolaLocalCompartilhamento->escola->nome_curto ?></strong>
            ?
        </p>
    </div>
    <div class="box-footer">
        <?= $this->Form->submit('Excluir Compartilhamento', [
            'style' => 'danger'
        ]) ?>
        
        <?= $this->Button->render([
            'text' => 'Cancelar',
            'icon' => 'cancelar',
            'url' => [
                'action' => 'infraCompartilhamentosListar',
                h($escola->id),
            ]
        ]) ?>
    </div>
</div>

<?= $this->Form->end() ?>
