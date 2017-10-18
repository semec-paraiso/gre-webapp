
<?= $this->Form->create($escolaLocal, ['novalidate' => true]) ?>

<div class="row">
    <div class="col-md-8">
        <?=
            $this->Form->input('nome', [
                'label' => 'Nome do local',
                'autofocus',
            ]);
        ?>
    </div>
    <div class="col-md-4">
        <?=
            $this->Form->input('predio_ocupacao_forma_id', [
                'label' => 'Forma de ocupação',
            ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <?=
            $this->Form->input('escola_local_tipo_id', [
                'label' => 'Tipo do local',
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
