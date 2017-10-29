<?php

$this->extend('_escolas_tabs_legislacao');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'icon' => 'cadastrar',
                    'text' => 'Cadastrar Reconhecimento',
                    'size' => 'small',
                    'style' => 'primary',
                    'url'  => [
                        'action' => 'legislacaoReconhecimentosCadastrar',
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
            <?= $this->Icon->render('lei') ?>
            Reconhecimento/Renovação de Reconhecimento de Cursos
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar); ?>
        </div>
    </div>
    <div class="box-body">
        
        <?php if (count($escola->reconhecimentos) < 1): ?>
        
            <div class="alert alert-info">
                Esta escola não possui nenhum ato de reconhecimento de curso
                cadastrado.
            </div>
        
        <?php else: ?>
        
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>
                            Curso
                        </th>
                        <th>
                            Ato de Reconhecimento
                        </th>
                        <th>
                            Validade
                        </th>
                        <th class="options">
                            Opções
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($escola->reconhecimentos as $reconhecimento): ?>
                        <tr>
                            <td>
                                <?= h($reconhecimento->curso) ?>
                            </td>
                            <td>
                                <?= h($reconhecimento->ato) ?>
                                
                                <?php if ($reconhecimento->vencido()): ?>
                                    <span class="label label-danger">
                                        Vencido
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= $this->Date->br($reconhecimento->validade) ?>
                            </td>
                            <td class="options">
                                <?= $this->ButtonGroup->render([
                                    'buttons' => [
                                        array(
                                            'icon' => 'editar',
                                            'size' => 'xsmall',
                                            'title' => 'Editar Ato',
                                            'url' => [
                                                'action' => 'legislacaoReconhecimentosEditar',
                                                h($reconhecimento->id),
                                            ]
                                        ),
                                        array(
                                            'icon' => 'excluir',
                                            'size' => 'xsmall',
                                            'title' => 'Excluir Ato',
                                            'url' => [
                                                'action' => 'legislacaoReconhecimentosExcluir',
                                                h($reconhecimento->id),
                                            ],
                                            'confirm' => "Deseja excluir o Ato \"{$reconhecimento->ato}\" ?"
                                        ),
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        
                </tbody>
            </table>
        
        <?php endif; ?>
        
    </div>
</div>
