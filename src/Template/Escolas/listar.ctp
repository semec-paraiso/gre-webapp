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
    
    <?php if (!$escolas->count()): ?>
    
        <div class="box-body">
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
        </div>
    
    <?php else: ?>
    
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>
                        Nome da Escola
                    </th>
                    <th>
                        Bairro
                    </th>
                    <th style="text-align: center;">
                        Situação
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($escolas as $escola): ?>
                    <tr>
                        <td>
                            <?=
                                $this->Html->link(
                                    h($escola->nome_curto),
                                    ['action' => 'identificacao-visualizar', h($escola->id)],
                                    ['title' => 'Visualizar informações desta escola']
                                );
                            ?>
                        </td>
                        <td>
                            <?= h($escola->endereco_bairro) ?>
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
    
    <div class="box-footer">
        <?= $this->Paginator->numbers() ?>
    </div>
</div>
