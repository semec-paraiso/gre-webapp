<?php

$this->extend('_escolas_tabs');
$this->assign('content-subtitle', 'Edição da identificação da escola');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'text' => 'Cancelar',
                    'icon' => 'cancelar',
                    'class' => 'default small',
                    'url' => [
                        'action' => 'identificacao-exibir',
                        h($escola->id),
                    ],
                ),
            ],
        ),
    ],
];

$escola->endereco_uf_id = $escola->endereco_distrito->municipio->uf->id;
$escola->endereco_municipio_id = $escola->endereco_distrito->municipio->id;

?>

<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            <?= $this->Icon->render('editar') ?>
            Editar identificação da escola
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar) ?>
        </div>
    </div>
    <div class="box-body">
        <?php require_once '_form_identificacao.ctp'; ?>
    </div>
</div>
