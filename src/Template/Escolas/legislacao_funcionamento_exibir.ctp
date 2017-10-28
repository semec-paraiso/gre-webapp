<?php

$this->extend('_escolas_tabs_legislacao');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'icon' => 'editar',
                    'text' => 'Editar Legislacao',
                    'size' => 'small',
                    'url'  => [
                        'action' => 'legislacaoFuncionamentoEditar',
                        h($escola->id),
                    ],
                ),
            ],
        ),
    ],  
];

?>

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
                <?= $this->Data->display('Ato de criação', $escola->leg_criacao) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Data->display('Ato de denominação', $escola->leg_denominacao) ?>
            </div>
        </div>
    </div>
</div>

