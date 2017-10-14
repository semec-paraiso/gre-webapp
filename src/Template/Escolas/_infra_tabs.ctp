<?php

$this->extend('_escolas_tabs');

$listGroupItems = [
    'geral' => [
        'text' => 'Geral',
        'url'  => [
            'action' => 'infra-geral-visualizar',
            h($escola->id),
        ],
    ],
    'locais' => [
        'text' => 'Locais',
        'url'  => [
            'action' => 'infra-locais-visualizar',
            h($escola->id),
        ],
    ],
    'dependencias' => [
        'text' => 'Dependências',
        'url'  => [
            'action' => 'infra-dependencias-visualizar',
            h($escola->id),
        ],
    ],
    'compartilhamentos' => [
        'text' => 'Compartilhamentos',
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
}
$listGroupItems[$active]['active'] = true;

$listGroup = [
    'items' => $listGroupItems,
    'class' => 'list-group-horizontal',
];

?>

<?= $this->ListGroup->render($listGroup) ?>

<?= $this->fetch('content') ?>