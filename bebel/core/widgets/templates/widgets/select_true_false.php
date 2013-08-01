<h4 class="widget_title_top"><label for="<?php echo $this->get_field_id($key) ?>"><?php echo $widget['title'] ?></label></h4>

<div class="widget_widget">
  <select id="<?php echo $this->get_field_id($key) ?>" name="<?php echo $this->get_field_name($key) ?>">
      <option value="on" <?php echo $this->getOption($key) == 'on' ? 'selected="selected"' : '' ?>><?php _e('Yes', $this->settings->getThemename()) ?></option>
      <option value="off" <?php echo $this->getOption($key) == 'off' ? 'selected="selected"' : '' ?>><?php _e('No', $this->settings->getThemename()) ?></option>
  </select>
  <p class="help"><?php echo $widget['description']?></p>
</div>


<br class="clear" />