<?php

$this->extend('_escolas_tabs_infra');

$toolbar = [
    'groups' => [
        array(
            'buttons' => [
                array(
                    'text' => 'Cancelar',
                    'icon' => 'cancelar',
                    'class' => 'warning small',
                    'url' => [
                        'action' => 'infraCompartilhamentosListar',
                        h($escola->id),
                    ],
                ),
            ],
        ),
    ],
];

?>

<div class="box box-default">
    <?=
        $this->Box->header([
            'icon' => 'editar',
            'text' => 'Cadastro Compartilhamento de Local de Funcionamento da Escola',
            'toolbar' => $toolbar,
        ]);
    ?>
    <div class="box-body">
        <?= $this->Form->create($escolaLocalCompartilhamento, ['novalidate' => true]) ?>
        <div class="row">
            <div class="col-md-6">
                <?= $this->Form->input('escola_local_id', [
                    'label' => 'Local compartilhado',
                ]) ?>
            </div>
        </div>
        <fieldset>
            <legend>
                Dados da escola
            </legend>
            <div class="row">
                <div class="col-md-2">
                    <?= $this->Form->input('uf_id', [
                        'label' => 'UF',
                        'id' => 'inputUf',
                        'empty' => '-',
                        'required' => 'required',
                    ]) ?>
                </div>
                <div class="col-md-10">
                    <?= $this->Form->input('municipio_id', [
                        'id' => 'inputMunicipio',
                        'label' => 'Município',
                        'required' => 'required',
                        'disabled',
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->Form->input('escola_id', [
                        'label' => 'Escola',
                        'id' => 'inputEscola',
                        'disabled',
                    ]) ?>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->submit() ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
    
function carregarEscolas(municipioId) {
    if (!parseInt(municipioId)) {
        $('#inputEscola').empty().attr('disabled', 'disabled');
        return false;
    }
    $.ajax({
        'url': '<?= $this->Url->build(['controller' => 'escolas', 'action' => 'listarPorMunicipio'], true) ?>/' + municipioId.toString(),
        'dataType': 'json',
        'success': function(data) {
            $('#inputEscola').empty();
            var option = document.createElement('option');
            option.innerHTML = '- Selecione a Escola -';
            $('#inputEscola').append(option);
            $.each(data.escolas, function(key, escola){
                var option = document.createElement('option');
                option.value = escola.id;
                option.innerHTML = escola.nome_curto;
                if (escola.id == '<?= h($escolaLocalCompartilhamento->escola_id) ?>') {
                    option.selected = 'selected';
                }  
                $('#inputEscola').append(option);
            });
            $('#inputEscola').removeAttr('disabled');
        },
    });
}
    
function carregarMunicipios(ufId) {
    if (!parseInt(ufId)) {
        $('#inputMunicipio').empty().attr('disabled', 'disabled');
        $('#inputEscola').empty().attr('disabled', 'disabled');
        return false;
    }
    $.ajax({
        'url': '<?= $this->Url->build(['controller' => 'municipios', 'action' => 'listar'], true) ?>/' + ufId.toString(),
        'dataType': 'json',
        'success': function(data) {
            $('#inputMunicipio').empty();
            var option = document.createElement('option');
            option.innerHTML = '- Selecione o Município -';
            $('#inputMunicipio').append(option);
            $.each(data.municipios, function(key, municipio){
                var option = document.createElement('option');
                option.value = municipio.id;
                option.innerHTML = municipio.nome;
                if (municipio.id == '<?= h($escolaLocalCompartilhamento->municipio_id) ?>') {
                    option.selected = 'selected';
                }   
                $('#inputMunicipio').append(option);
            });
            $('#inputMunicipio').removeAttr('disabled');
            carregarEscolas($('#inputMunicipio').val());
        },
    });
}

$('#inputUf').change(function(){
    carregarMunicipios($('#inputUf').val());
});

$('#inputMunicipio').change(function(){
    carregarEscolas($('#inputMunicipio').val());
});

$(document).ready(function(){
    carregarMunicipios($('#inputUf').val());
    carregarEscolas($('#inputMunicipio').val());
});

</script>