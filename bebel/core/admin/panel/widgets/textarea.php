<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">
  <div class="widget">
    <textarea cols="62" rows="10" name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>]"><?php echo $this->settings->get($key) ?></textarea>
    <p class="help"><?php echo $widget['description']?></p>
  </div>

</div>