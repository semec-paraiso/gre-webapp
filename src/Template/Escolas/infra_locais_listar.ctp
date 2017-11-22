<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'text' => 'Cadastrar Local',
                    'icon' => 'cadastrar',
                    'class' => 'primary small',
                    'url' => [
                        'action' => 'infra-locais-cadastrar',
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
            Locais de funcionamento da escola
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar) ?>
        </div>
    </div>
    <div class="box-body">
        <?php if (count($escola->escola_locais) < 1) : ?>
            <div class="alert alert-info">
                Esta escola não possui locais de funcionamento cadastrados. Utilize
                o botão <strong>Cadastrar Local</strong> para inserir um novo
                local de funcionamento.
            </div>
        <?php else: ?>
            <table class="table table-hover table-condensed table-">
                <thead>
                    <tr>
                        <th>
                            Nome do local
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Ocupação
                        </th>
                        <th class="options">
                            Opções
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($escola->escola_locais as $local): ?>
                        <tr>
                            <td>
                                <?= h($local->nome) ?>
                            </td>
                            <td>
                                <?= h($local->escola_local_tipo->nome) ?>
                            </td>
                            <td>
                                <?= h($local->predio_ocupacao_forma->nome) ?>
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
                                                    'action' => 'infra-locais-editar',
                                                    h($local->id),
                                                ],
                                            ),
                                            array(
                                                'icon' => 'excluir',
                                                'class' => 'default xsmall',
                                                'title' => 'Excluir este local',
                                                'url' => [
                                                    'action' => 'infra-locais-excluir',
                                                    h($local->id),
                                                ],
                                            ),
                                        ],
                                    ]);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
