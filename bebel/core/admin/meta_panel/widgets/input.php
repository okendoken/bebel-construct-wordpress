<div class="widget_title">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="widget_widget">
  <input type="text" name="<?php echo $this->settings->getPrefix().'_'.$key ?>" value="<?php echo $this->getOption($key) == '' && isset($widget['default']) ? $widget['default'] : $this->getOption($key) ?>" />
  <p class="help"><?php echo $widget['description']?></p>
</div>


<br class="clear" />