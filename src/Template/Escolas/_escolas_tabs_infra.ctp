<?php

$this->extend('_escolas_tabs');

$listGroupItems = [
    'geral' => [
        'text' => 'Caracterização',
        'url'  => [
            'action' => 'infra-caracterizacao-exibir',
            h($escola->id),
        ],
    ],
    'locais' => [
        'text' => 'Locais',
        'url'  => [
            'action' => 'infra-locais-listar',
            h($escola->id),
        ],
    ],
    'salas' => [
        'text' => 'Salas de Aula',
        'url'  => [
            'action' => 'infraSalasListar',
            h($escola->id),
        ],
    ],
    'compartilhamentos' => [
        'text' => 'Compartilhamentos',
        'url'  => [
            'action' => 'infra-compartilhamentos-exibir',
            h($escola->id),
        ],
    ],  
];

$active = key($listGroupItems);
switch ($this->request->params['action']) {
    case 'infraCaracterizacaoExibir':
    case 'infraCaracterizacaoEditar':
        $active = 'geral';
        break;
    case 'infraLocaisListar':
    case 'infraLocaisCadastrar':
    case 'infraLocaisEditar':
    case 'infraLocaisExcluir':
        $active = 'locais';
        break;
    case 'infraSalasListar':
    case 'infraSalasCadastrar':
    case 'infraSalasEditar':
    case 'infraSalasExcluir':
        $active = 'salas';
        break;
    case 'infraDependenciasListar':
        $active = 'dependencias';
        break;
}
$listGroupItems[$active]['active'] = true;

$listGroup = [
    'items' => $listGroupItems,
    'class' => 'list-group-horizontal',
];

?>

<?= $this->ListGroup->render($listGroup) ?>

<?= $this->fetch('content') ?>