<li class="active treeview menu-open">
    <a href="#" class="text-teal">
        <?= $this->Icon->render('professor') ?>
        <span>
            Professor
        </span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li>
            <?=
                $this->Html->link(
                    $this->Icon->render('diario') . ' Diário Escolar',
                    ['controller' => 'escolas', 'action' => 'listar'],
                    ['escape' => false]
                );
            ?>
        </li>
    </ul>
</li>