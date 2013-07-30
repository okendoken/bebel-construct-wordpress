<?php 
    // calculate rgb values from hex code
    $color = BebelUtils::hex2rgb($this->settings->get($key));
    
?>

<script type="text/javascript">
<!--
jQuery(document).ready(function() {

    jQuery('.colorSelector_<?php echo $key ?>').ColorPicker({
        color: '#<?php echo $this->settings->get($key) ?>',
        onShow: function (colpkr) {
            jQuery(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            jQuery(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            jQuery('.colorSelector_<?php echo $key ?> div').css('backgroundColor', '#' + hex);
            jQuery('.color_<?php echo $key ?>').val('#'+hex);
            
        }
    });
});
-->
</script>

<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">
  <div class="widget">
    <input style="float: left; margin-top: 7px; margin-right: 5px;" type="text" value="<?php echo $this->settings->get($key) ?>" class="color_<?php echo $key ?>" name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>]" />
    
    <div id="colorSelector" class="colorSelector_<?php echo $key ?>">
        <div style="background-color: rgb(<?php echo $color[0] ?>, <?php echo $color[1] ?>, <?php echo $color[2] ?>);"></div>
    </div>
    <p class="help"><?php echo $widget['description']?></p>
  </div>
  
</div>