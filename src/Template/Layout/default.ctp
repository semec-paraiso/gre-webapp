<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>GRE - Paraíso do Tocantins</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= $this->element('styles') ?>
        <?= $this->element('scripts') ?>
    </head>
    <body class="hold-transition skin-red-light sidebar-mini sidebar-collapse">
        <div class="wrapper">
            <?= $this->element('header') ?>
            <?= $this->element('sidebar') ?>
            <div class="content-wrapper">
                <?= $this->Flash->render() ?>
                <?= $this->element('content/header') ?>
                <section class="content">
                    <?= $this->fetch('content') ?>
                </section>
            </div>
            <?= $this->element('footer') ?>
        </div>
    </body>
</html>
