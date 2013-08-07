<?php
$settings = BebelSingleton::getInstance('BebelSettings');
$postSlider = BebelSingleton::getInstance('postSlider');

$interval = $settings->get('bebel_slide_display_time') * 1000;
$interval = $settings->get('bebel_slider_auto_rotate') == 'on' ? $interval : 'false';
?>

<div id='home-carousel' class='<?php echo is_home() ? 'home-carousel' : 'page-carousel';?> carousel slide' data-interval='<?php echo $interval;?>'>
    <?php echo $postSlider->getHtml(); ?>
</div>