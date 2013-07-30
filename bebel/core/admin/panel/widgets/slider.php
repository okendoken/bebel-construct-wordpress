<script tyle="text/javascript">
  <!--
  jQuery(document).ready(function() {
    jQuery('#bebel_jquery_range_<?php echo $key; ?>').slider({
			range: "min",
			value: <?php echo $this->settings->get($key) ?>,
			min: <?php echo $widget['options']['min']; ?>,
			max: <?php echo $widget['options']['max']; ?>,
			slide: function( event, ui ) {
				jQuery( "#bebel_jquery_range_<?php echo $key; ?>_value" ).val( ui.value );
			}
    });
    jQuery( "#bebel_jquery_range_<?php echo $key; ?>_value" ).val( jQuery( "#bebel_jquery_range_<?php echo $key; ?>" ).slider( "value" ) );
  });
  -->
</script>
<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">
  <div class="widget">
    <div id="bebel_jquery_range_<?php echo $key; ?>"></div>
    <input type="text" id="bebel_jquery_range_<?php echo $key; ?>_value" value="<?php echo $this->settings->get($key) ?>" name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>]" />
    <p class="help"><?php echo $widget['description']?></p>
  </div>

</div>