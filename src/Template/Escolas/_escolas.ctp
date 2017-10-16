<?php

$this->set('contentHeader', [
    'icon' => 'escola',
    'text' => 'Escolas',
    'url' => ['action' => 'listar'],
    'linkOptions' => [
        'title' => 'Listar todas as escolas',
    ],
]);

echo $this->fetch('content');
