<li class="active treeview menu-open">
    <a href="#" class="text-yellow">
        <?= $this->Icon->render('secretaria') ?>
        <span>
            Secretaria Escolar
        </span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li>
            <?=
                $this->Html->link(
                    $this->Icon->render('alunos') . ' Alunos',
                    ['controller' => 'escolas', 'action' => 'listar'],
                    ['escape' => false]
                );
            ?>
        </li>
        <li>
            <?=
                $this->Html->link(
                    $this->Icon->render('matricula') . ' Matrículas',
                    ['controller' => 'escolas', 'action' => 'listar'],
                    ['escape' => false]
                );
            ?>
        </li>
    </ul>
</li>