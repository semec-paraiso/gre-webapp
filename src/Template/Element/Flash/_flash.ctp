<div class="container-fluid">
    <div class="alert-dismissible flash alert alert-<?= $this->fetch('flash-class') ?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p>
            <strong>
                <?= $this->Icon->render($this->fetch('flash-icon')) ?>
            </strong>
            <?= $this->fetch('flash-message') ?>
        </p>
    </div>
</div>
     