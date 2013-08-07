<?php
$postSlider = NULL;
if (BebelSingleton::hasInstance('postSlider')){
    $postSlider = BebelSingleton::getInstance('postSlider');
}
$settings = BebelSingleton::getInstance('BebelSettings');
$activeProgress = isset($postSlider) && $postSlider->hasImages()
    && !$postSlider->hasSingleImage() && $settings->get('bebel_slider_auto_rotate') == 'on';
?>

<nav class="navigation navigation-page navigation-top">
    <div id="home-carousel-progress" class="progress progress-danger hidden-phone">
        <div class="bar<?php echo $activeProgress ? ' animation' : '';?>" style="width: <?php echo $activeProgress ? '0' : '100%';?>"></div>
    </div>
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