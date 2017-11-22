<?php

$this->extend('_escolas');
$this->assign('content-subtitle', 'Relação de Escolas cadastradas');

$escolaSituacoes[0] = 'Todas as situações';
ksort($escolaSituacoes);

?>

<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            <?= $this->Icon->render('lista') ?>
            Relação de Escolas
        </h3>
        
        <div class="box-tools">
            <div class="btn-group">
                <?=
                    $this->Button->render([
                        'text'  => 'Cadastrar Escola',
                        'icon'  => 'cadastrar',
                        'class' => 'primary small',
                        'url'   => ['action' => 'cadastrar'],
                    ]);
                ?>
            </div>
        </div>
    </div>
    
    <?= $this->Form->create(null, ['method' => 'get']) ?>
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $this->Form->input('nome', [
                        'label' => 'Nome da Escola',
                        'value' => h($filters['nome']),
                        'autofocus',
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Form->input('situacao_id', [
                        'label' => 'Situação',
                        'type' => 'select',
                        'options' => $escolaSituacoes,
                        'default' => h($filters['situacao_id']),
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Form->input('rede', [
                        'label' => 'Situação',
                        'type' => 'select',
                        'options' => [
                            1 => 'Apenas escolas da Rede',
                            0 => 'Todas as escolas',
                        ],
                        'default' => h($filters['rede']),
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                        <?=
                            $this->Form->submit('Pesquisar', [
                                'style' => 'default',
                                'icon'  => 'pesquisar',
                            ]);
                        ?>
                        <?=
                            $this->Button->render([
                                'text'  => 'Limpar pesquisa',
                                'icon'  => 'cancelar',
                                'url' => [
                                    'action' => 'listar',
                                    'limpar'
                                ]
                            ]);
                        ?>
                </div>
            </div>
        </div>
    
    <?= $this->Form->end() ?>
    
    <div class="box-body">
        
    <?php if (!$escolas->count()): ?>
    
        <div class="alert alert-info">
            <h4>
                <?= $this->Icon->render('triste') ?>
                Nada encontrado!
            </h4>
            <p>
                Não existem escolas cadastradas ou a pesquisa não retornou 
                nenhum resultado.
            </p>
        </div>
    
        <?php else: ?>

            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 90px;">
                            INEP
                        </th>
                        <th>
                            Nome da Escola
                        </th>
                        <th>
                            Município
                        </th>
                        <th style="text-align: center">
                            UF
                        </th>
                        <th style="text-align: center;">
                            Situação
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($escolas as $escola): ?>
                        <tr>
                            <td style="text-align: center;">
                                <?= h($this->Mask->inepEscola($escola->inep_codigo)) ?>
                            </td>
                            <td>
                                <?=
                                    $this->Html->link(
                                        h($escola->nome_curto),
                                        ['action' => 'identificacaoExibir', h($escola->id)],
                                        ['title' => 'Visualizar informações desta escola']
                                    );
                                ?>
                                
                                <?php if (!$escola->rede): ?>
                                    <?= $this->Label->render(['text' => 'fora da rede']) ?>
                                <?php endif; ?>
                                
                            </td>
                            <td>
                                <?= h($escola->endereco_distrito->municipio->nome) ?>
                            </td>
                            <td style="text-align: center">
                                <?= h($escola->endereco_distrito->municipio->uf->sigla) ?>
                            </td>
                            <td style="text-align: center;">
                                <?=
                                    $this->Label->render([
                                        'class' => h($escola->escola_situacao->_webapp_css_class),
                                        'text'  => h($escola->escola_situacao->nome),
                                    ]);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

        <?php endif; ?>
    
    </div>
    
    <div class="box-footer">
        <?= $this->Paginator->numbers() ?>
    </div>
</div>
