<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'style' => 'primary',
                    'icon' => 'cadastrar',
                    'text' => 'Cadastrar Dependência',
                    'size' => 'small',
                ),
            ],
        ),
    ],
];

?>

<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            <?= $this->Icon->render('lista') ?>
            Dependências da escola
        </h3>
        <?php if (count($escola->escola_locais) > 0) : ?> 
            <div class="box-tools">
                <?= $this->Toolbar->render($toolbar) ?>
            </div>
        <?php endif;?>
    </div>
    <div class="box-body">
        <div class="input-group">
            <span class="input-group-addon">
                <strong>
                    Local de Funcionamento:
                </strong>
            </span>
            <?=
                $this->Form->input('escola_local_id', [
                    'type' => 'select',
                    'label' => false,
                    'options' => $locais,
                    'default' => $local->id,
                    'id' => 'selectLocal',
                ]);
            ?>
        </div>
    </div>
    <div class="box-body">
        <?php if (count($dependencias) < 1) : ?>
            <div class="alert alert-info">
                <p>
                    Esta escola não possui nenhuma dependência cadastrada neste
                    local de funcionamento. Informe todas as dependências da
                    escola através do botão <strong>Cadastrar Dependência</strong>.
                </p>
            </div>
        <?php else: ?>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>
                            Dependência
                        </th>
                        <th style="text-align: center;">
                            Características
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th class="options">
                            Opções
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dependencias as $dependencia) : ?>
                        <tr>
                            <td>
                                <?= h($dependencia->nome) ?>
                            </td>
                            <td style="text-align: center">
                                <?=
                                    $this->Label->render([
                                        'text' => $this->Icon->render('saladeaula'),
                                        'style' => $dependencia->aula ? 'success' : 'default',
                                        'title' => 'Sala de aula: ' . ($dependencia->aula ? 'SIM' : 'NÃO'),
                                    ]);
                                ?>
                                <?=
                                    $this->Label->render([
                                        'text' => $this->Icon->render('acessibilidade'),
                                        'style' => $dependencia->acessibilidade ? 'success' : 'default',
                                        'title' => 'Acessibilidade: ' . ($dependencia->acessibilidade ? 'SIM' : 'NÃO'),
                                    ]);
                                ?>
                                <?=
                                    $this->Label->render([
                                        'text' => $this->Icon->render('infantil'),
                                        'style' => $dependencia->infantil ? 'success' : 'default',
                                        'title' => 'Adaptado à Educação Infantil: ' . ($dependencia->infantil ? 'SIM' : 'NÃO'),
                                    ]);
                                ?>
                            </td>
                            <td>
                                <?= $dependencia->escola_dependencia_tipo->nome ?>
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
                                                    'action' => 'infra-local-editar',
                                                    h($dependencia->id),
                                                ],
                                            ),
                                            array(
                                                'icon' => 'excluir',
                                                'size' => 'xsmall',
                                                'title' => 'Excluir este local',
                                                'url' => [
                                                    'action' => 'infra-local-excluir',
                                                    h($dependencia->id),
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

<script>

$('#selectLocal').change(function(){
    var url = '<?= $this->Url->build(['action' => 'infra-dependencias-listar', h($escola->id)], true) ?>/';
    url += $('#selectLocal').val();
    console.log('Redirecionando para: ' + url);
    window.location.replace(url);
});

</script>
