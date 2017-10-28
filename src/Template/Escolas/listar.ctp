<?php

$this->extend('_escolas');
$this->assign('content-subtitle', 'Relação de Escolas cadastradas');

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
                        'style' => 'primary',
                        'size' => 'small',
                        'url'   => ['action' => 'cadastrar'],
                    ]);
                ?>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <input class="form-control" placeholder="Nome da escola..." />
                </div>
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-addon">
                        Situação: 
                    </span>
                    <select class="form-control">
                        <option>Em funcionamento</option>
                        <option>Paralisadas</option>
                        <option>Extintas</option>
                        <option>Todas</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <?=
                        $this->Button->render([
                            'text'  => 'Pesquisar',
                            'icon'  => 'pesquisar',
                        ]);
                    ?>
                    <?=
                        $this->Button->render([
                            'text'  => 'Limpar pesquisa',
                            'icon'  => 'cancelar',
                            'style' => 'warning',
                        ]);
                    ?>
            </div>
        </div>
    </div>
    
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
                                        'style' => h($escola->escola_situacao->_webapp_label_style),
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
