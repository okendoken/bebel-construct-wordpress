<?php
$settings = BebelSingleton::getInstance('BebelSettings');
$postSlider = BebelSingleton::getInstance('postSlider');?>

<div id='home-carousel' class='<?php echo is_front_page() ? 'home-carousel' : 'page-carousel';?> carousel slide'>
    <?php echo $postSlider->getHtml(); ?>
</div>