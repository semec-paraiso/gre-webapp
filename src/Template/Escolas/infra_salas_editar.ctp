<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'text' => 'Cancelar',
                    'icon' => 'cancelar',
                    'class' => 'warning small',
                    'url' => [
                        'action' => 'infraSalasListar',
                        h($escola->id),
                    ],
                ),
            ],
        ),
    ],
];

?>

<div class="box box-default">
    <?= $this->Box->header([
        'icon' => 'editar',
        'text' => 'Editar informações da Sala de Aula',
        'toolbar' => $toolbar,
    ]) ?>
    <div class="box-body">
        <?php require_once 'infra_salas_form.ctp'; ?>
    </div>
</div>
