<h4 class="widget_title_top"><label for="<?php echo $this->get_field_id($key) ?>"><?php echo $widget['title'] ?></label></h4>

<div class="widget_widget">
  <textarea cols="35" rows="5" id="<?php echo $this->get_field_id($key) ?>" name="<?php echo $this->get_field_name($key) ?>"><?php echo $this->getOption($key) ?></textarea>
  <p class="help"><?php echo $widget['description']?></p>
</div>


<br class="clear" />