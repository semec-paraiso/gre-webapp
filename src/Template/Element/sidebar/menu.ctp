<ul class="sidebar-menu" data-widget="tree">
    <li>
        <a href="#" class="text-blue">
            <?= $this->Icon->render('painel') ?>
            </i> <span>Painel Principal</span></a>
    </li>
    <?= $this->element('sidebar/menu/rede-gestao') ?>
    <?= $this->element('sidebar/menu/professor') ?>
    <?= $this->element('sidebar/menu/escola-secretaria') ?>
    <?= $this->element('sidebar/menu/sistema-manutencao') ?>
</ul>