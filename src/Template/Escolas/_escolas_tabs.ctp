<?php

$this->extend('_escolas');

$this->assign('content-subtitle', h($escola->nome_curto));

$listGroupItems = [
    'identificacao' => [
        'icon' => 'info',
        'text' => 'Identificação',
        'url'  => [
            'action' => 'identificacao-visualizar',
            h($escola->id),
        ],
    ],
    'infra' => [
        'icon' => 'infra',
        'text' => 'Infraestrutura',
        'url'  => [
            'action' => 'infra-geral-visualizar',
            h($escola->id),
        ],
    ],
    'equipamentos' => [
        'icon' => 'equipamento',
        'text' => 'Equipamentos',
        'url'  => [
            'action' => 'equipamentos-visualziar',
            h($escola->id),
        ],
    ],
    'contato' => [
        'icon' => 'contato',
        'text' => 'Contatos',
        'url'  => [
            'action' => 'contatos-visualizar',
            h($escola->id),
        ],
    ],
    'rh' => [
        'icon' => 'rh',
        'text' => 'Recursos Humanos',
        'url'  => [
            'action' => 'rh-visualizar',
            h($escola->id),
        ],
    ],
    'educacao' => [
        'icon' => 'educacao',
        'text' => 'Dados Educacionais',
        'url'  => [
            'action' => 'educacao-visualizar',
            h($escola->id),
        ],
    ],
];

$active = key($listGroupItems);
switch ($this->request->params['action']) {
    case 'identificacaoVisualizar':
    case 'identificacaoEditar':
        $active = 'identificacao';
        break;
    case 'infraGeralVisualizar':
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
