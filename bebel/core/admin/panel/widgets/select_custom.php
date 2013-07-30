<?php
  $title = isset($widget['options']['first']) ? $widget['options']['first'] : 'Template';
?>
<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">
  <div class="widget">
    <select name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>]">
      <?php echo BebelUtils::createListByOptions($this->settings->get($key), $widget['options']['options'], $title); ?>
    </select>

    <p class="help"><?php echo $widget['description']?></p>
  </div>
</div>