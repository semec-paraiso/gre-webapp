<?php

$this->extend('_escolas');

$this->assign('content-subtitle', h($escola->nome_curto));

$listGroupItems = [
    'identificacao' => [
        'icon' => 'info',
        'text' => 'Identificação',
        'url'  => [
            'action' => 'identificacaoExibir',
            h($escola->id),
        ],
    ],
    'legislação' => [
        'icon' => 'lei',
        'text' => 'Legislação',
        'url'  => [
            'action' => 'legislacaoExibir',
            h($escola->id),
        ],
    ],
    'infra' => [
        'icon' => 'infra',
        'text' => 'Infraestrutura',
        'url'  => [
            'action' => 'infraCaracterizacaoExibir',
            h($escola->id),
        ],
    ],
    'contato' => [
        'icon' => 'contato',
        'text' => 'Contatos',
        'url'  => [
            'action' => 'contatosListar',
            h($escola->id),
        ],
    ],
    'rh' => [
        'icon' => 'rh',
        'text' => 'Recursos Humanos',
        'url'  => [
            'action' => 'rhListar',
            h($escola->id),
        ],
    ],
    'educacao' => [
        'icon' => 'educacao',
        'text' => 'Dados Educacionais',
        'url'  => [
            'action' => 'educacaoExibir',
            h($escola->id),
        ],
    ],
];

$active = key($listGroupItems);
switch ($this->request->params['action']) {
    case 'identificacaoExibir':
    case 'identificacaoEditar':
        $active = 'identificacao';
        break;
    case 'infraCaracterizacaoExibir':
    case 'infraCaracterizacaoEditar':
    case 'infraLocaisListar':
    case 'infraLocaisCadastrar':
        $active = 'infra';
        break;
}
$listGroupItems[$active]['active'] = true;

?>

<div class="row">
    <div class="col-md-3">
        <?= $this->ListGroup->render(['items' => $listGroupItems]) ?>
        <?=
            $this->Button->default([
                'icon' => 'excluir',
                'text' => 'Excluir Escola',
                'class' => 'btn-block',
            ]);
        ?>
    </div>
    <div class="col-md-9">
        <?= $this->fetch('content') ?>
    </div>
</div>
