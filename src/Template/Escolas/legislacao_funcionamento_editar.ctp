<?php

$this->extend('_escolas_tabs_legislacao');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'icon' => 'cancelar',
                    'text' => 'Cancelar',
                    'size' => 'small',
                    'style' => 'warning',
                    'url'  => [
                        'action' => 'legislacaoFuncionamentoExibir',
                        h($escola->id),
                    ],
                ),
            ],
        ),
    ],  
];

?>

<?= $this->Form->create($escola) ?>

<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            <?= $this->Icon->render('lei') ?>
            Legislação de funcionamento da Escola
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar); ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $this->Form->input('leg_criacao', [
                    'label' => 'Ato de criação',
                    'autofocus',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->input('leg_denominacao', [
                    'label' => 'Ato de denominação',
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->submit() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>
