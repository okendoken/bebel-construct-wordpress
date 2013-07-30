<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">
  <div class="widget">
    <input type="text" value="<?php echo $this->settings->get($key) ?>" name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>]" />
    <p class="help"><?php echo $widget['description']?></p>
  </div>
  
</div>