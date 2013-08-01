<h4 class="widget_title_top"><label for="<?php echo $this->get_field_id($key) ?>"><?php echo $widget['title'] ?></label></h4>

<div class="widget_widget">
  <input type="text" id="<?php echo $this->get_field_id($key) ?>" name="<?php echo $this->get_field_name($key) ?>" value="<?php echo $this->getOption($key) ?>" />
  <p class="help"><?php echo $widget['description']?></p>
</div>


<br class="clear" />