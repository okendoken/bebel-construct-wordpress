<?php $unique_id = uniqid(); ?>
<h4 class="widget_title_top"><label for="<?php echo $this->get_field_id($key) ?>"><?php echo $widget['title'] ?></label></h4>

<div class="widget_widget">
  <input type="text" id="field<?php echo $unique_id ?>" name="<?php echo $this->get_field_name($key) ?>" value="<?php echo $this->getOption($key) ?>" />
  <input class="widefat" style="max-width: 150px" id="upload_<?php echo $unique_id ?>" type="button" value="<?php echo isset($widget['options']['button_text']) ? $widget['options']['button_text'] : 'Upload' ?>" />
  <p class="help"><?php echo $widget['description']?></p>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() {

    var formfield_<?php echo $unique_id ?>;
    jQuery("#upload_<?php echo $unique_id ?>").click(function() {
      jQuery("html").addClass("Image");
      formfield_<?php echo $key ?> = 'field_<?php echo $unique_id ?>';
      tb_show("","media-upload.php?type=image&post_id=9999990&TB_iframe=true");
      return false;
    });

    window.original_send_to_editor_<?php echo $unique_id ?> = window.send_to_editor;
    window.send_to_editor = function(html){

      if (formfield_<?php echo $unique_id ?>) {
        fileurl = jQuery(html).attr('href');
        jQuery("#field_<?php echo $unique_id ?>").val(fileurl);
        tb_remove();
        jQuery("html").removeClass("Image");
      } else {
        window.original_send_to_editor_<?php echo $unique_id ?>(html);
      }
    };

  });
</script>

<br class="clear" />