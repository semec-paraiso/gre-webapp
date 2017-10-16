<?php

$defaultOptions = [
    'icon' => 'default',
    'text' => 'DEFINIR TITULO DA PÁGINA',
    'url' => '#',
    'linkOptions' => [],
];
$contentHeader = array_merge($defaultOptions, $contentHeader);
$contentHeader['linkOptions']['escape'] = false;

?>

<h1 class="content-title">
    <?=
        $this->Html->link(
            $this->Icon->render($contentHeader['icon']) . $contentHeader['text'], 
            $contentHeader['url'],
            $contentHeader['linkOptions']
        );
    ?>
    <span class="content-subtitle">
        <?= $this->fetch('content-subtitle') ?>
    </span>
</h1>
