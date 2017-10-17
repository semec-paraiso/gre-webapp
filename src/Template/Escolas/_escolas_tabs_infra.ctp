<?php

$this->extend('_escolas_tabs');

$listGroupItems = [
    'geral' => [
        'text' => 'Caracterização',
        'icon' => 'infra',
        'url'  => [
            'action' => 'infra-caracterizacao-exibir',
            h($escola->id),
        ],
    ],
    'locais' => [
        'text' => 'Locais',
        'icon' => 'locais',
        'url'  => [
            'action' => 'infra-locais-listar',
            h($escola->id),
        ],
    ],
    'salas' => [
        'text' => 'Salas de Aula',
        'icon' => 'dependencias',
        'url'  => [
            'action' => 'infra-salas-listar',
            h($escola->id),
        ],
    ],
    'compartilhamentos' => [
        'text' => 'Compartilhamentos',
        'icon' => 'compartilhar',
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
        $active = 'locais';
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