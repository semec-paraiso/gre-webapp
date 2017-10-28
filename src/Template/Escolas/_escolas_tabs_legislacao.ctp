<?php

$this->extend('_escolas_tabs');

$listGroupItems = [
    'geral' => [
        'text' => 'Funcionamento',
        'url'  => [
            'action' => 'legislacaoFuncionamentoExibir',
            h($escola->id),
        ],
    ],
    'reconhecimento' => [
        'text' => 'Reconhecimento de Cursos',
        'url'  => [
            'action' => 'legislacaoReconhecimentosListar',
            h($escola->id),
        ],
    ],  
];

$active = key($listGroupItems);
switch ($this->request->params['action']) {
    case 'legExibir':
    case 'infraCaracterizacaoEditar':
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