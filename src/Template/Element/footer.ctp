<?php

$entidade = \Cake\Core\Configure::read('Rede.Entidade');
$versao = \Cake\Core\Configure::read('version');

?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Versão</b> <?= $versao ?>
    </div>
    <strong>GRE</strong> - <?= $entidade['nome_curto'] ?> -
    <?= $entidade['municipio'] ?> (<?= $entidade['uf'] ?>)
</footer>