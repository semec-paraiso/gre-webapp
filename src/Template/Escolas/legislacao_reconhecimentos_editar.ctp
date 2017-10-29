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
                        'action' => 'legislacaoReconhecimentosListar',
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
            Cadastro de Reconhecimento/Renovação de Reconhecimento de Curso
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar); ?>
        </div>
    </div>
    <div class="box-body">
        <?php require_once '_form_reconhecimento.ctp' ?>
    </div>
</div>
