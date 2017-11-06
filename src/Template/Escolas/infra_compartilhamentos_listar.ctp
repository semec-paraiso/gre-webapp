<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'text' => 'Cadastrar Compartilhamento',
                    'icon' => 'cadastrar',
                    'size' => 'small',
                    'style' => 'primary',
                    'url' => [
                        'action' => 'infraCompartilhamentosCadastrar',
                        h($escola->id),
                    ],
                ),
            ],
        ),
    ],
];

$escolaLocais[0] = 'Todos os Locais';
ksort($escolaLocais);

?>

<div class="box box-default">
    
    <div class="box-header">
        <h3 class="box-title">
            <?= $this->Icon->render('lista') ?>
            Compartilhamentos de Local
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar) ?>
        </div>
    </div>
    
    <div class="box-body">
        <?= $this->Form->create(null, ['method' => 'get']) ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $this->Form->input('escola_local_id', [
                        'label' => 'Local',
                        'options' => $escolaLocais,
                        'default' => $filters['escola_local_id'],
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->Form->submit('Pesquisar', [
                        'icon' => 'pesquisar',
                        'text' => 'Pesquisar',
                        ]) ?>
                    <?= $this->Button->render([
                        'icon' => 'cancelar',
                        'text' => 'Limpar pesquisa',
                        'url' => [
                            'action' => 'infraCompartilhamentosListar',
                            h($escola->id),
                            'limpar',
                        ]
                    ]) ?>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </div>
    
    <div class="box-body">
        <?php if ($escola->qtdeCompartilhamentos < 1) : ?>
            <div class="alert alert-info">
                Não existe nenhum compartilhamento cadastrado para o local selecionado.
                Para informar um compartilhamento de local com outra escola, utilize
                o botão <strong>Cadastrar Compartilhamento</strong>.
            </div>
        <?php else: ?>
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>
                            Local
                        </th>
                        <th>
                            INEP
                        </th>
                        <th>
                            Escola
                        </th>
                        <th>
                            Município
                        </th>
                        <th>
                            UF
                        </th>
                        <th style="text-align: center;">
                            Opções
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($escola->escola_locais as $escolaLocal): ?>
                        <?php foreach($escolaLocal->escola_local_compartilhamentos as $compartilhamento): ?>
                            <tr>
                                <td>
                                    <?= h($escolaLocal->nome) ?>
                                </td>
                                <td>
                                    <?= $this->Mask->inepEscola($compartilhamento->escola->inep_codigo) ?>
                                </td>
                                <td>
                                    <?= h($compartilhamento->escola->nome_curto) ?>
                                </td>
                                <td>
                                    <?= h($compartilhamento->escola->endereco_distrito->municipio->nome) ?>
                                </td>
                                <td style="text-align: center;">
                                    <?= h($compartilhamento->escola->endereco_distrito->municipio->uf->sigla) ?>
                                </td>
                                <td class="options">
                                    <?=
                                        $this->ButtonGroup->render([
                                            'buttons' => [
                                                array(
                                                    'icon' => 'excluir',
                                                    'size' => 'xsmall',
                                                    'title' => 'Excluir este local',
                                                    'url' => [
                                                        'action' => 'infraCompartilhamentosExcluir',
                                                        h($compartilhamento->id),
                                                    ],
                                                ),
                                            ],
                                        ]);
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
