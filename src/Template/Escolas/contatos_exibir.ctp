<?php

$this->extend('_escolas_tabs');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'icon' => 'editar',
                    'text' => 'Editar Contatos',
                    'size' => 'small',
                    'url'  => [
                        'action' => 'contatosEditar',
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
            <?= $this->Icon->render('contato') ?>
            Contatos da Escola
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar); ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?= $this->Data->display('Telefone Principal', $escola->fone_1) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Data->display('Telefone Secretaria', $escola->fone_2) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Data->display('Telefone Celular', $escola->fone_3) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Data->display('Telefone Diretor(a)', $escola->fone_4) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Data->display('Email', $escola->email) ?>
            </div>
        </div>
    </div>
</div>
