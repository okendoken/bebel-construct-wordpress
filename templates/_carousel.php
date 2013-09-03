<?php
$settings = BebelSingleton::getInstance('BebelSettings');
$postSlider = BebelSingleton::getInstance('postSlider');?>

<div id='home-carousel' class='<?php echo is_home() ? 'home-carousel' : 'page-carousel';?> carousel slide'>
    <?php echo $postSlider->getHtml(); ?>
</div>
<script type="text/javascript">
    var mainRevSliderApi;
    jQuery(function(){
        document.mainRevSliderApi = revapi<?php echo $slider_id?>;
    });
</script>