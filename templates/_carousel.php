<?php
$settings = BebelSingleton::getInstance('BebelSettings');
$postSlider = BebelSingleton::getInstance('postSlider');

$interval = $settings->get('bebel_slider_display_time') * 1000;
?>

<div id='home-carousel' class='page-carousel carousel slide' data-interval='<?php echo $interval;?>'>
    <?php echo $postSlider->getHtml(); ?>
</div>