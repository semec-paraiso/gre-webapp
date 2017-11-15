<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'text' => 'Cadastrar Sala de Aula',
                    'icon' => 'cadastrar',
                    'class' => 'primary small',
                    'url' => [
                        'action' => 'infraSalasCadastrar',
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
            Salas de aula da escola
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
                        'label' => 'Local da Sala de Aula',
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
                            'action' => 'infraSalasListar',
                            h($escola->id),
                            'limpar',
                        ]
                    ]) ?>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </div>
    
    <div class="box-body">
        <?php if ($escola->qtdeSalas < 1) : ?>
            <div class="alert alert-info">
                Esta escola não possui salas de aula cadastrada no local selecionado.
                Utilize o botão <strong>Cadastrar Sala de Aula</strong> para
                incluir uma nova sala de aula.
            </div>
        <?php else: ?>
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>
                            Local
                        </th>
                        <th>
                            Nome da Sala
                        </th>
                        <th style="text-align: right;">
                            Capacidade
                        </th>
                        <th class="options">
                            Opções
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($escola->escola_locais as $escolaLocal): ?>
                        <?php foreach($escolaLocal->escola_salas as $escolaSala): ?>
                            <tr>
                                <td>
                                    <?= h($escolaLocal->nome) ?>
                                </td>
                                <td>
                                    <?= h($escolaSala->nome) ?>
                                </td>
                                <td style="text-align: right;">
                                    <?= h($escolaSala->capacidade) ?>
                                </td>
                                <td class="options">
                                    <?=
                                        $this->ButtonGroup->render([
                                            'buttons' => [
                                                array(
                                                    'icon' => 'editar',
                                                    'class' => 'default xsmall',
                                                    'title' => 'Editar as informações deste local',
                                                    'url' => [
                                                        'action' => 'infraSalasEditar',
                                                        h($escolaSala->id),
                                                    ],
                                                ),
                                                array(
                                                    'icon' => 'excluir',
                                                    'class' => 'default xsmall',
                                                    'title' => 'Excluir este local',
                                                    'url' => [
                                                        'action' => 'infraSalasExcluir',
                                                        h($escolaSala->id),
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
