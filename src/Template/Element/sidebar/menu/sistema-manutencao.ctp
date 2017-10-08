<li class="active treeview menu-open">
    <a href="#" class="text-maroon">
        <?= $this->Icon->render('sistema') ?>
        <span>
            Manutenção do Sistema
        </span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li>
            <?=
                $this->Html->link(
                    $this->Icon->render('escola') . 'Escolas',
                    ['controller' => 'escolas', 'action' => 'listar'],
                    ['escape' => false]
                );
            ?>
        </li>
    </ul>
</li>