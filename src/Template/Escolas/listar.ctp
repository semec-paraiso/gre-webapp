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
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Nome da Escola
                </th>
                <th>
                    Bairro
                </th>
                <th>
                    Opções
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach(range(1, 10) as $escola): ?>
                <tr>
                    <td>
                        <?=
                            $this->Html->link(
                                'Esc. Mun. Princesa Isabel',
                                ['action' => 'visualizar', $escola]
                            );
                        ?>
                    </td>
                    <td>
                        Setor Oeste
                    </td>
                    <td class="options">
                        
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="box-footer">
        
    </div>
</div>

<?= $this->Button->deffault(['text' => 'Teste']) ?>