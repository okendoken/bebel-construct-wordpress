<div class="widget_title">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="widget_widget">
  <input class="widefat" style="max-width: 150px" id="upload_button<?php echo $this->settings->getPrefix().'_'.$key ?>" type="button" value="<?php echo isset($widget['options']['button_text']) ? $widget['options']['button_text'] : 'Upload' ?>" />
  <p class="help"><?php echo $widget['description']?></p>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery("#upload_button<?php echo $this->settings->getPrefix().'_'.$key ?>").click(function() {
        tb_show("","media-upload.php?type=image&post_id=<?php echo $this->post->ID ?>&TB_iframe=true");
        return false;
      });
    });
  </script>
</div>
<div class="clear" > </div>
