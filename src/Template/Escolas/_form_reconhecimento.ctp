
<?= $this->Form->create($reconhecimento, ['novalidate' => true]) ?>

<div class="row">
    <div class="col-md-6">
        <?= $this->Form->input('curso', [
            'label' => 'Curso',
            'autofocus',
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $this->Form->input('ato', [
            'label' => 'Ato',
            'title' => 'Ato de reconhecimento ou renovação de reconhecimento de curso',
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <?= $this->Form->input('validade', [
            'label' => 'Validade',
            'type' => 'text',
            'plugin' => 'datepidcker',
            'mask' => 'dadte',
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $this->Form->submit() ?>
    </div>
</div>

<?= $this->Form->end() ?>
