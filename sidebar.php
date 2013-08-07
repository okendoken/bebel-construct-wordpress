<?php
$postSlider = NULL;
if (BebelSingleton::hasInstance('postSlider')){
    $postSlider = BebelSingleton::getInstance('postSlider');
}
?>

<!--sidebar-->
<aside class="sidebar">
    <?php if (isset($postSlider) && $postSlider->hasImages() && !$postSlider->hasSingleImage()) { ?>
        <div class="nav-links">
            <a class="left" href="#home-carousel" data-slide="prev"><i class="icon-chevron-left"></i></a>
            <span class="divider"></span>
            <a class="right" href="#home-carousel" data-slide="next"><i class="icon-chevron-right"></i></a>
        </div>
    <?php } ?>
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
    <?php endif; // end sidebar widget area ?>
</aside>