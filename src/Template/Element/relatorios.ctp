
<?php foreach ($groups as $i => $group): ?>

    <?php if ($i % 2 === 0): ?>
        <div class="row">
    <?php endif; ?>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="pull-right">
                        <?= $group['id'] ?>
                    </span>
                    <?= $group['title'] ?>
                </h3>
            </div>
            <div class="list-group">
                <?php foreach ($group['items'] as $item): ?>
                <a href="<?= $this->Url->build($item['url']) ?>" class="list-group-item">
                    <?= $this->Icon->render('relatorio') ?>
                    <span>
                        <?= h($item['text']) ?>
                    </span>
                    <span class="pull-right-container">
                        <span class="badge pull-right">
                            <?= $item['id'] ?>
                        </span>
                    </span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
            
    <?php if ($i % 2 === 0): ?>
        </div>
    <?php endif; ?>

<?php endforeach; ?>

