<?php
$postSlider = false;
if (BebelSingleton::hasInstance('postSlider')){
    $postSlider = BebelSingleton::getInstance('postSlider');
}
?>

<nav class="navigation navigation-page navigation-top">
    <?php if (isset($postSlider) && $postSlider->hasImages() && !$postSlider->hasSingleImage()) { ?>
        <div id="home-carousel-progress" class="progress progress-danger hidden-phone">
            <div class="bar" style="width: 0;"></div>
        </div>
    <?php } ?>
    <div class="navbar">
        <div class="navbar-inner">
            <a id="menu-toggle" class="pull-right btn-navbar" href="#" data-toggle="collapse" data-target=".nav-collapse">
                <span class="text">Menu</span> <i class="icon-reorder icon-large"></i>
            </a>

            <?php wp_nav_menu(array(
                'menu_class' => 'nav nav-collapse collapse',
                'container' => '',
                'walker' => new ConstructMenuWalker())) ?>
        </div>
    </div>
</nav>