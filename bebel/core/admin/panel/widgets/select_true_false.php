<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">
  <div class="widget">
    <select name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>]">
      <option value="on" <?php echo $this->settings->get($key) == 'on' ? 'selected="selected"' : '' ?>><?php _e('Yes', $this->settings->getThemename()) ?></option>
      <option value="off" <?php echo $this->settings->get($key) == 'off' ? 'selected="selected"' : '' ?>><?php _e('No', $this->settings->getThemename()) ?></option>
    </select>
    
    <p class="help"><?php echo $widget['description']?></p>
  </div>
</div>