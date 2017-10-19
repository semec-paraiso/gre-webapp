<?php

$this->extend('_escolas_tabs_infra');

?>

<?= $this->Form->create() ?>

<div class="box box-danger">
    <?=
        $this->Box->header([
            'icon' => 'excluir',
            'text' => 'Exclusão de local de funcionamento da escola',
        ]);
    ?>
    <div class="box-body">

                Deseja confirmar a exclusão do local de funcionamento
                <strong><?= h($escolaLocal->nome) ?></strong> desta escola?
    </div>
    <div class="box-footer">
        <?=
            $this->Form->submit('Excluir o local', [
                'style' => 'danger',
            ]);
        ?>
        <?=
            $this->Button->render([
                'icon' => 'cancelar',
                'text' => 'Cancelar',
                'url' => [
                    'action' => 'infraLocaisListar',
                    h($escola->id),
                ],
            ]);
        ?>
    </div>
</div>

<?= $this->Form->end() ?>
