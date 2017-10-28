<?php

$this->extend('_escolas_tabs');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'icon' => 'editar',
                    'text' => 'Editar Identificação',
                    'url'  => [
                        'action' => 'identificacao-editar',
                        h($escola->id),
                    ],
                ),
            ],
        ),
        array(
            'buttons' => [
                array(
                    'icon' => 'imprimir',
                ),
            ],
        ),
    ],  
];

?>

<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            <?= $this->Icon->render('info') ?>
            Identificação da Escola
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar); ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?= $this->Data->display('Situação',$escola->escola_situacao->nome); ?>
            </div>
            <div class="col-md-3">
                <?= $this->Data->display('Código INEP', $this->Mask->inepEscola(h($escola->inep_codigo))) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Data->display('Nome Curto', h($escola->nome_curto)) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Data->display('Nome Longo', h($escola->nome_longo)) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Data->display('Nome Jurídico', h($escola->nome_juridico)) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= $this->Data->display('CEP', $this->Mask->cep(h($escola->endereco_cep))) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Data->display('UF', h($escola->endereco_distrito->municipio->uf->sigla)) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Data->display('Município', h($escola->endereco_distrito->municipio->nome)) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Data->display('Distrito', h($escola->endereco_distrito->nome)) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <?= $this->Data->display('Endereço', h($escola->endereco_logradouro)) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Data->display('Número', h($escola->endereco_numero)) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $this->Data->display('Complemento', h($escola->endereco_complemento)) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Data->display('Bairro', h($escola->endereco_bairro)) ?>
            </div>
        </div>
    </div>
</div>

