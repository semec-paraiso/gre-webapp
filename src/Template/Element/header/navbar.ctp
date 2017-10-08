<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <?= $this->element('header/search') ?>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <?= $this->element('header/navbar/user') ?>
        </ul>
    </div>
</nav>