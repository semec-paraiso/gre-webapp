
<?= $this->Form->create($escolaSala) ?>

<div class="row">
    <div class="col-md-5">
        <?= $this->Form->input('escola_local_id', [
            'label' => 'Local',
            'autofocus',
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->Form->input('nome', [
            'label' => 'Nome da Sala de Aula'
        ]) ?>
    </div>
    <div class="col-md-3 number">
        <?= $this->Form->input('capacidade', [
            'label' => 'Capacidade',
            'title' => 'Quantidade de alunos'
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $this->Form->submit() ?>
    </div>
</div>

<?= $this->Form->end() ?>
