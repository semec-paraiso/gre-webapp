<?php

$this->extend('_escolas_tabs');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'icon' => 'editar',
                    'text' => 'Editar Contatos',
                    'class' => 'default small',
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
                <?= $this->Data->display('Telefone da Secretaria', $escola->fone_2) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Data->display('Telefone celular', $escola->fone_3) ?>
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
        <div class="row">
            <div class="col-md-12">
                <?= $this->Data->display('Website', $escola->website) ?>
            </div>
        </div>
    </div>
</div>
