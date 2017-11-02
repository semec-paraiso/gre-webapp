<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'text' => 'Cadastrar Sala de Aula',
                    'icon' => 'cadastrar',
                    'size' => 'small',
                    'style' => 'primary',
                    'url' => [
                        'action' => 'infraSalasCadastrar',
                        h($escola->id),
                    ],
                ),
            ],
        ),
    ],
];

?>

<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            Salas de aula da escola
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar) ?>
        </div>
    </div>
    <div class="box-body">
        <?php if ($escola->qtdeSalas < 1) : ?>
            <div class="alert alert-info">
                Esta escola não possui locais de funcionamento cadastrados. Utilize
                o botão <strong>Cadastrar Local</strong> para inserir um novo
                local de funcionamento.
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
                                                    'size' => 'xsmall',
                                                    'title' => 'Editar as informações deste local',
                                                    'url' => [
                                                        'action' => 'infra-locais-editar',
                                                        h($escolaSala->id),
                                                    ],
                                                ),
                                                array(
                                                    'icon' => 'excluir',
                                                    'size' => 'xsmall',
                                                    'title' => 'Excluir este local',
                                                    'url' => [
                                                        'action' => 'infra-locais-excluir',
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
