<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'icon' => 'editar',
                    'text' => 'Editar Caracterização',
                    'size' => 'small',
                    'url' => [
                        'action' => 'infraCaracterizacaoEditar',
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
            Caracterização geral da escola
        </h3>
        <div class="box-tools">
            <?= $this->Toolbar->render($toolbar) ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?=
                    $this->Data->yesOrNo(
                        'Água consumida',
                        $escola->infra_agua_filtrada,
                        array(
                            'values' => [
                                1 => 'Filtrada',
                                0 => 'Não filtrada',
                            ],
                            'title' => 'Água consumida pelos alunos',
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
                    <?= $this->Data->yesOrNo('Rede pública', $escola->infra_agua_abast_publica) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Poço artesiano', $escola->infra_agua_abast_poco) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Cacimba/Cisterna/Poco', $escola->infra_agua_abast_cacimba) ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Fonte/Rio/Igarapé/...',
                            $escola->infra_agua_abast_fonte,
                            ['title' => 'Fonte/Rio/Igarapé/Riacho/Córrego']
                        );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Inexistente', $escola->infra_agua_abast_inexistente) ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Abastecimento de energia elétrica
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Rede pública', $escola->infra_energia_abast_publica) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Gerador', $escola->infra_energia_abast_gerador) ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Outros ...',
                            $escola->infra_agua_abast_fonte,
                            ['title' => 'Outros (energia alternativa)']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Inexistente', $escola->infra_energia_abast_inexistente) ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Esgoto sanitário
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Rede pública', $escola->infra_esgoto_rede) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Fossa', $escola->infra_esgoto_fossa) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Inexistente', $escola->infra_esgoto_inexistente) ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Destinação do lixo
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Coleta periódica', $escola->infra_lixo_coleta) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Queima', $escola->infra_lixo_queima) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Joga em outra área', $escola->infra_lixo_joga) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Recicla', $escola->infra_lixo_recicla) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Enterra', $escola->infra_lixo_enterra) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Outros', $escola->infra_lixo_outros) ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                Dependências existentes na escola
            </legend>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Almoxarifado', $escola->infra_dep_almoxarifado) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Alojamento de aluno', $escola->infra_dep_alojamento_aluno) ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Aloj. de professor',
                            $escola->infra_dep_alojamento_professor,
                            ['title' => 'Alojamento de professor']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Área verde', $escola->infra_dep_area_verde) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Auditório', $escola->infra_dep_auditorio) ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Banheiro acessível',
                            $escola->infra_dep_banheiro_acessivel,
                            ['title' => 'Banheiro acessível, adequado ao uso dos alunos com deficiência ou mobilidade reduzida']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Banheiro infantil',
                            $escola->infra_dep_banheiro_infantil,
                            ['title' => 'Banheiro adequado à Educação Infantil']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Banheiro c/ chuveiro', $escola->infra_dep_banheiro_chuveiro) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Banheiro no prédio',
                            $escola->infra_dep_banheiro_dentro,
                            ['title' => 'Banheiro dentro do prédio']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Banheiro fora',
                            $escola->infra_dep_banheiro_fora,
                            ['title' => 'Banheiro fora do prédio']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Berçário', $escola->infra_dep_bercario) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Biblioteca', $escola->infra_dep_biblioteca) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Vias acessíveis',
                            $escola->infra_dep_vias_deficientes,
                            ['title' => 'Dependências e vias adequadas a alunos com deficiência ou mobilidade reduzida']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Lab. de ciências',
                            $escola->infra_dep_lab_ciencias,
                            ['title' => 'Laboratório de ciências']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Lab. de informática',
                            $escola->infra_dep_lab_informatica,
                            ['title' => 'Laboratório de informática']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Lavanderia', $escola->infra_dep_lavanderia) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Parque infantil', $escola->infra_dep_parque_infantil) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Pátio coberto', $escola->infra_dep_patio_coberto) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Parque descoberto', $escola->infra_dep_patio_descoberto) ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Quadra coberta',
                            $escola->infra_dep_quadra_coberta,
                            ['title' => 'Quadra de esportes coberta']
                        );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Quadra descoberta',
                            $escola->infra_dep_quadra_descoberta,
                            ['title' => 'Quadra de esportes descoberta']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo('Refeitório', $escola->infra_dep_refeitorio) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Sala de diretoria', $escola->infra_dep_sala_diretoria) ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Sala de leitura', $escola->infra_dep_sala_leitura) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Sala de professores', $escola->infra_dep_sala_professores) ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Sala de recursos',
                            $escola->infra_dep_sala_recursos,
                            ['title' => 'Sala de recursos multifuncionais para Atendimento Educacional Especializado (AEE)']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $this->Data->yesOrNo('Sala de secretaria', $escola->infra_dep_sala_diretoria) ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Nenhuma',
                            $escola->infra_dep_nenhuma,
                            ['title' => 'Nenhuma das dependências relacionadas']
                        );
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
                        $this->Data->display(
                            'Antena parabólica',
                            h($escola->infra_equip_parabolica),
                            ['class' => 'number']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Aparelho de DVD',
                            h($escola->infra_equip_dvd),
                            ['class' => 'number']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Aparelho de som',
                            h($escola->infra_equip_som),
                            ['class' => 'number']
                        )
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Aparelho de TV',
                            h($escola->infra_equip_tv),
                            ['class' => 'number']
                        );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Copiadora',
                            h($escola->infra_equip_copiadora),
                            ['class' => 'number']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Fax',
                            h($escola->infra_equip_fax),
                            ['class' => 'number']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Impressora',
                            h($escola->infra_equip_impressora),
                            ['class' => 'number']
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Impr. multifuncional',
                            h($escola->infra_equip_impressora_multi),
                            array(
                                'title' => 'Impressora multifuncional',
                                'class' => 'number',
                            )
                        );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Filmadora',
                            h($escola->infra_equip_filmadora),
                            array(
                                'title' => 'Máquina fotográfica/Filmadora',
                                'class' => 'number',
                            )
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Data show',
                            h($escola->infra_equip_projetor),
                            array(
                                'title' => 'Projetor multimídia (Data show)',
                                'class' => 'number',
                            )
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Retroprojetor',
                            h($escola->infra_equip_retroprojetor),
                            array(
                                'class' => 'number',
                            )
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Videocassete',
                            h($escola->infra_equip_videocassete),
                            array(
                                'class' => 'number',
                            )
                        );
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
                        $this->Data->display(
                            'Uso administrativo',
                            h($escola->infra_pc_admin),
                            array(
                                'class' => 'number',
                            )
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->display(
                            'Uso dos alunos',
                            h($escola->infra_pc_alunos),
                            array(
                                'class' => 'number',
                            )
                        );
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
                        $this->Data->yesOrNo(
                            'Acesso à internet',
                            $escola->infra_internet
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?=
                        $this->Data->yesOrNo(
                            'Internet banda larga',
                            h($escola->infra_internet_banda_larga),
                            array(
                                'values' => [
                                    0 => 'Não possui',
                                    1 => 'Possui',
                                ],
                            )
                        );
                    ?>
                </div>
            </div>
        </fieldset>
    </div>
</div>
