<div class="widget_title">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="widget_widget">
  <select name="<?php echo $this->settings->getPrefix().'_'.$key ?>">
    <?php echo BebelUtils::createListByOptions($this->getOption($key), array(0 => 'Disabled', 1 => 'Enabled')); ?>
  </select>
  <p class="help"><?php echo $widget['description']?></p>
</div>


<div class="clear" > </div>