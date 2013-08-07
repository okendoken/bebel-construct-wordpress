<?php

if(!isset($this->post))
{
  $post_id = 999999;
}else {
  $post_id = $this->post->ID;
}

?>
<div class="widget_title">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="widget_widget">
  <input type="text" id="<?php echo $this->settings->getPrefix().'_'.$key ?>"  name="<?php echo $this->settings->getPrefix().'_'.$key ?>" value="<?php echo $this->getOption($key) ?>" />
  <input class="widefat" style="max-width: 150px" id="upload_big_post_image<?php echo $this->settings->getPrefix().'_'.$key ?>" type="button" value="<?php echo isset($widget['options']['button_text']) ? $widget['options']['button_text'] : 'Upload' ?>" />
  <p class="help"><?php echo $widget['description']?></p>
  <script type="text/javascript">
    jQuery(document).ready(function() {

      var formfield<?php echo $this->settings->getPrefix().'_'.$key ?>;
      jQuery("#upload_big_post_image<?php echo $this->settings->getPrefix().'_'.$key ?>").click(function() {
        jQuery("html").addClass("Image");
        formfield<?php echo $this->settings->getPrefix().'_'.$key ?> = jQuery("#<?php echo $this->settings->getPrefix().'_'.$key ?>").attr("id");
        tb_show("","media-upload.php?type=image&post_id=<?php echo $post_id ?>&TB_iframe=true");
        return false;
      });

      window.original_send_to_editor_<?php echo $this->settings->getPrefix().'_'.$key ?> = window.send_to_editor;
      window.send_to_editor = function(html){

        if (formfield<?php echo $this->settings->getPrefix().'_'.$key ?>) {
          fileurl = jQuery(html).attr('href');
          jQuery("#<?php echo $this->settings->getPrefix().'_'.$key ?>").val(fileurl);
          tb_remove();
          jQuery("html").removeClass("Image");
        } else {
          window.original_send_to_editor_<?php echo $this->settings->getPrefix().'_'.$key ?>(html);
        }
      };

    });
  </script>
</div>
<div class="clear" > </div>
