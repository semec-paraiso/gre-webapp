<?php

$this->extend('_escolas_tabs');

?>

<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            <?= $this->Icon->render('relatorios') ?>
            Relatórios da Escola
        </h3>
    </div>
    <div class="box-body">
        <?= $this->element('relatorios', [
            'groups' => [
                array(
                    'id' => 'A.01',
                    'title' => 'Dados Cadastrais',
                    'items' => [
                        array(
                            'id' => 'A.01.01',
                            'text' => 'Perfil da Escola',
                            'url' => [
                                'action' => 'repPerfil',
                                h($escola->id),
                            ]
                        )
                    ]
                )
            ]
        ]) ?>
    </div>
</div>

