<?php

$this->extend('_escolas');
$this->assign('content-subtitle', 'Cadastro de Escola');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'icon' => 'cancelar',
                    'text' => 'Cancelar',
                    'url'  => ['action' => 'listar'],
                ),
            ],
        ),
    ],
];

?>

<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            <?= $this->Icon->render('editar') ?>
            Cadastro de Escola
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar); ?>
        </div>
    </div>
    <div class="box-body">
        <?php require_once '_form_identificacao.ctp'; ?>
    </div>
</div>
