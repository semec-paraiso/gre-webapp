<li class="active treeview menu-open">
    <a href="#" class="text-green">
        <?= $this->Icon->render('rede') ?>
        <span>
            Gestão da Rede
        </span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li>
            <?=
                $this->Html->link(
                    $this->Icon->render('profissionais') . ' Profissionais',
                    ['controller' => 'profissionais', 'action' => 'listar'],
                    ['escape' => false]
                );
            ?>
        </li>
        <li>
            <?=
                $this->Html->link(
                    $this->Icon->render('exercicio') . ' Exercícios',
                    ['controller' => 'profissionais', 'action' => 'listar'],
                    ['escape' => false]
                );
            ?>
        </li>
        <li>
            <?=
                $this->Html->link(
                    $this->Icon->render('escola') . ' Escolas',
                    ['controller' => 'escolas', 'action' => 'listar'],
                    ['escape' => false]
                );
            ?>
        </li>
    </ul>
</li>