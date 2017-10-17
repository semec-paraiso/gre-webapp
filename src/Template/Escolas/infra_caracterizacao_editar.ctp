<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'text' => 'Cancelar',
                    'icon' => 'cancelar',
                    'size' => 'small',
                    'style' => 'warning',
                    'url' => [
                        'action' => 'infraCaracterizacaoExibir',
                        h($escola->id),
                    ],
                ),
            ],
        ),
    ],
];

?>

<?= $this->Form->create($escola) ?>

<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            <?= $this->Icon->render('editar') ?>
            Editar caracterização da escola
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar) ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?=
                    $this->Form->input(
                        'infra_agua_filtrada',
                        array(
                            'type' => 'select',
                            'label' => 'Água consumida',
                            'options' => [
                                1 => 'Filtrada',
                                0 => 'Não filtrada',
                            ],
                        )
                    );
                ?>
            </div>
        </div>
        <fieldset>
            <legend>
                Abastecimento de água
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_agua_abast_publica', [
                            'label' => 'Rede pública',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_agua_abast_poco', [
                            'label' => 'Poço artesiano',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_agua_abast_cacimba', [
                            'label' => 'Cacimba/Cisterna...',
                            'title' => 'Cacimba/Cisterna/Poço',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_agua_abast_cacimba', [
                            'label' => 'Fonte/Rio/Igarapé...',
                            'title' => 'Fonte/Rio/Igarapé/Riacho/Córrego',
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_agua_abast_inexistente', [
                            'label' => 'Inexistente',
                        ]);
                    ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Abastecimento de energia elétrica
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_energia_abast_publica', [
                            'label' => 'Rede pública',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_energia_abast_gerador', [
                            'label' => 'Gerador',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_agua_abast_fonte', [
                            'label' => 'Outros ...',
                            'title' => 'Outros (energia alternativa)',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_energia_abast_inexistente', [
                            'label' => 'Inexistente',
                        ]);
                    ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Esgoto sanitário
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_esgoto_rede', [
                            'label' => 'Rede pública',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_esgoto_fossa', [
                            'label' => 'Fossa',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_esgoto_inexistente', [
                            'label' => 'Inexistente',
                        ]);
                    ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Destinação do lixo
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_lixo_coleta', [
                            'label' => 'Coleta periódica',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_lixo_queima', [
                            'label' => 'Queima',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_lixo_joga', [
                            'label' => 'Joga em outra área',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_lixo_recicla', [
                            'label' => 'Recicla',
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_lixo_enterra', [
                            'label' => 'Enterra',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_lixo_outros', [
                            'label' => 'Outros',
                        ]);
                    ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Dependências existentes na escola
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_almoxarifado', [
                            'label' => 'Almoxarifado',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_alojamento_aluno', [
                            'label' => 'Alojamento de aluno',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_alojamento_professor', [
                            'label' => 'Aloj. de professor',
                            'title' => 'Alojamento de professor',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_area_verde', [
                            'label' => 'Área verde',
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_auditorio', [
                            'label' => 'Auditório',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_banheiro_acessivel', [
                            'label' => 'Banheiro acessível',
                            'title' => 'Banheiro acessível, adequado ao uso dos alunos com deficiência ou mobilidade reduzida',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_banheiro_infantil', [
                            'label' => 'Banheiro infantil',
                            'title' => 'Banheiro adequado à Educação Infantil',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_banheiro_chuveiro', [
                            'label' => 'Banheiro c/ chuveiro',
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_banheiro_dentro', [
                            'label' => 'Banheiro no prédio',
                            'title' => 'Banheiro dentro do prédio',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_banheiro_fora', [
                            'label' => 'Banheiro fora prédio',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_bercario', [
                            'label' => 'Berçário',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_biblioteca', [
                            'label' => 'Biblioteca',
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_vias_deficientes', [
                            'label' => 'Vias acessíveis',
                            'title' => 'Dependências e vias adequadas a alunos com deficiência ou mobilidade reduzida',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_lab_ciencias', [
                            'label' => 'Lab. de ciências',
                            'title' => 'Laboratório de ciências',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_lab_informatica', [
                            'label' => 'Lab. de informática',
                            'title' => 'Laboratório de informática',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_lavanderia', [
                            'label' => 'Lavanderia',
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_parque_infantil', [
                            'label' => 'Parque infantil',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_patio_coberto', [
                            'label' => 'Pátio coberto',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_patio_descoberto', [
                            'label' => 'Parque descoberto',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_quadra_coberta', [
                            'label' => 'Quadra coberta',
                            'title' => 'Quadra de esportes coberta',
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_quadra_descoberta', [
                            'label' => 'Quadra descoberta',
                            'title' => 'Quadra de esportes descoberta',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_refeitorio', [
                            'label' => 'Refeitório',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_sala_diretoria', [
                            'label' => 'Sala de diretoria',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_sala_leitura', [
                            'label' => 'Sala de leitura',
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_sala_professores', [
                            'label' => 'Sala de professores',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_sala_recursos', [
                            'label' => 'Sala de recursos',
                            'title' => 'Sala de recursos multifuncionais para Atendimento Educacional Especializado (AEE)',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_sala_diretoria', [
                            'label' => 'Sala de secretaria',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_dep_nenhuma', [
                            'label' => 'Nenhuma',
                            'title' => 'Nenhuma das dependências relacionadas',
                        ]);
                    ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Quantidade de equipamentos
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_parabolica',[
                            'label' => 'Antena parabólica',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_dvd',[
                            'label' => 'Aparelho de DVD',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_som',[
                            'label' => 'Aparelho de som',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_tv',[
                            'label' => 'Aparelho de TV',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_copiadora',[
                            'label' => 'Copiadora',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_fax',[
                            'label' => 'Fax',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_impressora',[
                            'label' => 'Impressora',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_impressora_multi',[
                            'label' => 'Imp. multifuncional',
                            'title' => 'Impressora multifuncional',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_filmadora',[
                            'label' => 'Filmadora',
                            'title' => 'Máquina fotográfica/Filmadora',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_projetor',[
                            'label' => 'Data show',
                            'title' => 'Projetor multimídia (Data show)',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_retroprojetor',[
                            'label' => 'Retroprojetor',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_equip_videocassete',[
                            'label' => 'Videocassete',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Quantidade de computadores
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_pc_admin',[
                            'label' => 'Uso administrativo',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= 
                        $this->Form->input('infra_pc_alunos',[
                            'label' => 'Uso dos alunos',
                            'class' => 'number',
                            'min' => 0,
                        ]);
                    ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Internet
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Form->yesOrNo('infra_internet', [
                            'label' => 'Acesso à internet',
                        ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Form->input(
                            'infra_internet_banda_larga',
                            array(
                                'type' => 'select',
                                'label' => 'Internet banda larga',
                                'options' => [
                                    1 => 'Possui',
                                    0 => 'Não possui',
                                ],
                            )
                        );
                    ?>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->submit() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>
