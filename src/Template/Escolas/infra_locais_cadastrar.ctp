<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'text' => 'Cancelar',
                    'icon' => 'cancelar',
                    'size' => 'small',
                    'style' => 'warning',
                    'url' => [
                        'action' => 'infraLocaisListar',
                        h($escola->id),
                    ],
                ),
            ],
        ),
    ],
];

?>

<div class="box box-default">
    <?=
        $this->Box->header([
            'icon' => 'editar',
            'text' => 'Cadastrar local de funcionamento da escola',
            'toolbar' => $toolbar,
        ])
    ?>
    <div class="box-body">
        <?php require_once 'infra_locais_form.ctp'; ?>
    </div>
</div>
