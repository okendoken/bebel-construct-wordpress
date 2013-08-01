<?php 
    // calculate rgb values from hex code
    $color = BebelUtils::hex2rgb($this->getOption($key));
    
    
?>

<script type="text/javascript">
<!--
jQuery(document).ready(function() {

    jQuery('.colorSelector_<?php echo $this->get_field_id($key) ?>').ColorPicker({
        color: '#<?php echo $this->getOption($key) ?>',
        onShow: function (colpkr) {
            jQuery(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            jQuery(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            jQuery('.colorSelector_<?php echo $this->get_field_id($key) ?> div').css('backgroundColor', '#' + hex);
            jQuery('#<?php echo $this->get_field_id($key) ?>').val('#'+hex);
            
        }
    });
});
-->
</script>

<h4 class="widget_title_top"><label for="<?php echo $this->get_field_id($key) ?>"><?php echo $widget['title'] ?></label></h4>

<div class="widget_widget">
  <input type="text" id="<?php echo $this->get_field_id($key) ?>" name="<?php echo $this->get_field_name($key) ?>" value="<?php echo $this->getOption($key) ?>" />
  <div id="colorSelector" class="colorSelector_<?php echo $this->get_field_id($key) ?>">
        <div style="background-color: rgb(<?php echo $color[0] ?>, <?php echo $color[1] ?>, <?php echo $color[2] ?>);"></div>
  </div>
  
  <p class="help"><?php echo $widget['description']?></p>
</div>


<br class="clear" />

