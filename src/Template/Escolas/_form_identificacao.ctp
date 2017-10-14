<?= $this->Form->create($escola) ?>

<div class="row">
    <div class="col-md-3">
        <?=
            $this->Form->input('situacao_id', [
                'type'      => 'select',
                'options'   => $escolaSituacoes,
                'label'     => 'Situação',
                'autofocus',
            ]);
        ?>
    </div>
    <div class="col-md-3">
        <?=
            $this->Form->input('inep_codigo', [
                'label' => 'Código INEP',
            ]);
        ?>
    </div>
    <div class="col-md-6">
        <?=
            $this->Form->input('nome_curto', [
                'label' => 'Nome Curto'
            ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?=
            $this->Form->input('nome_longo', [
                'label' => 'Nome Longo'
            ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?=
            $this->Form->input('nome_juridico', [
                'label' => 'Nome Jurídico'
            ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <?=
            $this->Form->input('endereco_cep', [
                'label' => 'CEP'
            ]);
        ?>
    </div>
    <div class="col-md-3">
        <?=
            $this->Form->input('endereco_uf_id', [
                'label'   => 'UF',
                'type'    => 'select',
                'options' => $ufs,
                'empty'   => '-',
                'id'      => 'enderecoUf',
            ]);
        ?>
    </div>
    <div class="col-md-6">
        <?=
            $this->Form->input('endereco_municipio_id', [
                'label'    => 'Município',
                'type'     => 'select',
                'id'       => 'enderecoMunicipio',
                'disabled',
            ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?=
            $this->Form->input('endereco_distrito_id', [
                'label'    => 'Distrito',
                'type'     => 'select',
                'disabled',
                'id'       => 'enderecoDistrito',
            ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <?=
            $this->Form->input('endereco_logradouro', [
                'label' => 'Logradouro',
            ]);
        ?>
    </div>
    <div class="col-md-3">
        <?=
            $this->Form->input('endereco_numero', [
                'label' => 'Número',
            ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?=
            $this->Form->input('endereco_complemento', [
                'label' => 'Complemento',
            ]);
        ?>
    </div>
    <div class="col-md-6">
        <?=
            $this->Form->input('endereco_bairro', [
                'label' => 'Bairro',
            ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $this->Form->submit() ?>
    </div>
</div>

<?= $this->Form->end() ?>

<script>
    
function selecionarMunicipio(id) {
    console.log('Selecionando município default: ' + id);
    $('#enderecoMunicipio option[value='+ id +']').prop('selected', 'selected');
}

function selecionarDistrito(id) {
    console.log('Selecionando distrito default: ' + id);
    $('#enderecoDistrito option[value='+ id +']').prop('selected', 'selected');
}
    
function carregarDistritos(selectMunicipio) {
    console.log('Carregando distritos do municipio: ' + selectMunicipio.val());
    if (selectMunicipio.val()) {
        $.ajax({
            'url': '<?= $this->Url->build(['controller' => 'distritos', 'action' => 'listar'], true) ?>/' + selectMunicipio.val(),
            'dataType': 'json',
            'success':  function(data) {
                $('#enderecoDistrito').empty();
                $.each(data.distritos, function(key, distrito) {
                    var option = document.createElement('option');
                    option.value = distrito.id;
                    option.innerHTML = distrito.nome;
                    $('#enderecoDistrito').append(option);
                });
                $('#enderecoDistrito').removeAttr('disabled');
                console.log('(Ok) Distritos carregados!');
                selecionarDistrito(<?= $escola->endereco_distrito_id ?>);
            }
        });
    } else {
        $('#enderecoDistrito').empty();
        $('#enderecoDistrito').attr('disabled', 'disabled');
        console.log('(Falhou) Erro no carregamento dos distritos!');
    }
}
    
function carregarMunicipios(selectUf) {
    console.log('Carregando municipios do estado: ' + selectUf.val());
    if (selectUf.val()) {
        $.ajax({
            'url': '<?= $this->Url->build(['controller' => 'municipios', 'action' => 'listar'], true) ?>/' + selectUf.val(),
            'dataType': 'json',
            'success':  function(data) {
                $('#enderecoMunicipio').empty();
                $.each(data.municipios, function(key, municipio) {
                    var option = document.createElement('option');
                    option.value = municipio.id;
                    option.innerHTML = municipio.nome;
                    $('#enderecoMunicipio').append(option);
                });
                $('#enderecoMunicipio').removeAttr('disabled');
                console.log('(Ok) Municípios carregados!');
                selecionarMunicipio(<?= $escola->endereco_municipio_id ?>);
                carregarDistritos($('#enderecoMunicipio'));
            }
        });
    } else {
        $('#enderecoMunicipio').empty();
        $('#enderecoMunicipio').attr('disabled', 'disabled');
        console.log('(Falhou) Erro no carregamento dos municípios!');
    }
}

$('#enderecoUf').change(function(){
    carregarMunicipios($('#enderecoUf'));
});

$('#enderecoMunicipio').change(function(){
    carregarDistritos($('#enderecoMunicipio'));
});

$(document).ready(function(){
    carregarMunicipios($('#enderecoUf'));
});

</script>
