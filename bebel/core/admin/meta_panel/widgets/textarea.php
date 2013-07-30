<div class="widget_title">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="widget_widget">
  <textarea cols="50" rows="10" name="<?php echo $this->settings->getPrefix().'_'.$key ?>"><?php echo $this->getOption($key) ?></textarea>
  <p class="help"><?php echo $widget['description']?></p>
</div>


<br class="clear" />