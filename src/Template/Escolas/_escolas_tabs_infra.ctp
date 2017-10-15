<?php

$this->extend('_escolas_tabs');

$listGroupItems = [
    'geral' => [
        'text' => 'Geral',
        'icon' => 'infra',
        'url'  => [
            'action' => 'infra-geral-visualizar',
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
    'dependencias' => [
        'text' => 'Dependências',
        'icon' => 'dependencias',
        'url'  => [
            'action' => 'infra-dependencias-listar',
            h($escola->id),
        ],
    ],
    'compartilhamentos' => [
        'text' => 'Compartilhamentos',
        'icon' => 'compartilhar',
        'url'  => [
            'action' => 'infra-compartilhamentos-visualizar',
            h($escola->id),
        ],
    ],  
];

$active = key($listGroupItems);
switch ($this->request->params['action']) {
    case 'infraGeralVisualizar':
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