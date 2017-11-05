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
    'legislacao' => [
        'icon' => 'lei',
        'text' => 'Legislação',
        'url'  => [
            'action' => 'legislacaoFuncionamentoExibir',
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
            'action' => 'contatosExibir',
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
    'relatorios' => [
        'icon' => 'relatorios',
        'text' => 'Relatórios',
        'url'  => [
            'action' => 'relatorios',
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
    case 'legislacaoFuncionamentoExibir':
    case 'legislacaoFuncionamentoEditar':
    case 'legislacaoReconhecimentosListar':
    case 'legislacaoReconhecimentosCadastrar':
    case 'legislacaoReconhecimentosEditar':
        $active = 'legislacao';
        break;
    case 'infraCaracterizacaoExibir':
    case 'infraCaracterizacaoEditar':
    case 'infraLocaisListar':
    case 'infraLocaisCadastrar':
    case 'infraLocaisEditar':
    case 'infraLocaisExcluir':
    case 'infraSalasListar':
    case 'infraSalasCadastrar':
    case 'infraSalasEditar':
    case 'infraSalasExcluir':        
        $active = 'infra';
        break;
    case 'contatosExibir':
    case 'contatosEditar':
        $active = 'contato';
        break;
    case 'relatorios':
        $active = 'relatorios';
        break;
}
$listGroupItems[$active]['active'] = true;

?>

<div class="row">
    <div class="col-md-3">
        <?= $this->ListGroup->render(['items' => $listGroupItems]) ?>
        
        <?php if ($escola->rede): ?>
        
            <?= $this->Button->default([
                'icon' => 'retirar',
                'text' => 'Retirar Escola da Rede',
                'class' => 'btn-block',
                'confirm' => 'Deseja retirar esta escola da rede GRE?',
                'url' => [
                    'action' => 'greRetirar',
                    h($escola->id),
                ],
            ]); ?>
        
        <?php else: ?>
        
            <?= $this->Button->default([
                'icon' => 'incluir',
                'text' => 'Integrar Escola à Rede',
                'class' => 'btn-block',
                'confirm' => 'Deseja integrar esta escola à rede GRE?',
                'url' => [
                    'action' => 'greIntegrar',
                    h($escola->id),
                ],                    
            ]) ?>
        
        <?php endif; ?>
        
        <hr />
        
        <?=
            $this->Button->danger([
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
