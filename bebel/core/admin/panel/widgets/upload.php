<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">
  <div class="widget">
    <input type="text" value="<?php echo $this->settings->get($key) ?>" id="<?php echo $key; ?>" name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>]" />
    <input class="widefat" style="max-width: 150px" id="upload_big_post_image<?php echo $key ?>" type="button" value="<?php echo isset($widget['options']['button_text']) ? $widget['options']['button_text'] : 'Upload' ?>" />
    <p class="help"><?php echo $widget['description']?></p>
  </div>
  <script type="text/javascript">
    jQuery(document).ready(function() {

      var formfield<?php echo $key ?>;
      jQuery("#upload_big_post_image<?php echo $key ?>").click(function() {
        jQuery("html").addClass("Image");
        formfield<?php echo $key ?> = jQuery("#<?php echo $key ?>").attr("id");
        tb_show("","media-upload.php?type=image&post_id=0&TB_iframe=true");
        return false;
      });

      window.original_send_to_editor_<?php echo $key ?> = window.send_to_editor;
      window.send_to_editor = function(html){

        if (formfield<?php echo $key ?>) {
          fileurl = jQuery(html).attr('href');
          jQuery("#<?php echo $key ?>").val(fileurl);
          tb_remove();
          jQuery("html").removeClass("Image");
        } else {
          window.original_send_to_editor_<?php echo $key ?>(html);
        }
      };

    });
  </script>
</div>