<?php

$this->extend('_escolas_tabs');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'icon' => 'cancelar',
                    'text' => 'Cancelar',
                    'class' => 'warning small',
                    'url'  => [
                        'action' => 'contatosExibir',
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
        
        <?= $this->Form->create($escola) ?>
        
        <div class="row">
            <div class="col-md-3">
                <?= $this->Form->input('fone_1', array(
                    'label' => 'Telefone principal',
                    'autofocus',
                )) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->input('fone_2', array(
                    'label' => 'Telefone da Secretaria'
                )) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->input('fone_3', array(
                    'label' => 'Telefone celuar'
                )) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->input('fone_4', array(
                    'label' => 'Telefone Diretor(a)'
                )) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->input('email', array(
                    'label' => 'Email'
                )) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->input('website', array(
                    'label' => 'Website'
                )) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->submit() ?>
            </div>
        </div>
        
        <?= $this->Form->end() ?>
        
    </div>
</div>
